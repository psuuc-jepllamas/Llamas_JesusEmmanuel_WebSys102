<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = trim($request->username);
        $password = trim($request->password);

        $user = DB::select("SELECT * FROM users WHERE LOWER(username) = LOWER(?)", [$username]);

        if (!$user || $password !== $user[0]->password) {
            return back()->withErrors(['login_error' => 'Invalid username or password']);
        }

        if ($user[0]->is_banned) {
            return back()->withErrors(['login_error' => 'Your account has been banned.']);
        }

        session(['user' => $user[0]->username]);
        return redirect('/home');
    }
    
    public function registrationForm(){
        return view('auth.registration');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        DB::insert("INSERT INTO users (username, password, is_banned, created_at, updated_at) VALUES (?, ?, 0, NOW(), NOW())", [
            $request->username,
            $request->password,
        ]);

        DB::insert("INSERT INTO activities (description, created_at) VALUES (?, NOW())", [
            "New user: {$request->username}",
        ]);

        return redirect('/login')->with('success', 'Registration successful. Please login.');
    }

    public function logout(){
        session()->forget('user');
        return redirect('/login');
    }

    public function home(){
        if(!session('user')){
            return redirect('/login')->withErrors(['access_denied' => 'Login first']);
        }

        return view('home', ['username' => session('user')]);
    }

    public function index(Request $request)
    {
        if (!session('user')) {
            return redirect('/login')->withErrors(['access_denied' => 'Please login first.']);
        }

        $featuredPosts = DB::select("SELECT * FROM posts WHERE status = 'published' ORDER BY created_at DESC LIMIT 3");

        $selectedCategory = $request->query('category');
        $selectedTag = $request->query('tag');
        $search = $request->query('search');
        $page = $request->query('page', 1);
        $perPage = 9;

        $query = "SELECT * FROM posts WHERE status = 'published'";
        $countQuery = "SELECT COUNT(*) as total FROM posts WHERE status = 'published'";
        $params = [];
        $conditions = [];

        if ($selectedCategory) {
            $conditions[] = "category = ?";
            $params[] = $selectedCategory;
        }

        if ($selectedTag) {
            $conditions[] = "tags LIKE ?";
            $params[] = "%$selectedTag%";
        }

        if ($search) {
            $conditions[] = "(title LIKE ? OR body LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }

        if (!empty($conditions)) {
            $query .= " AND " . implode(" AND ", $conditions);
            $countQuery .= " AND " . implode(" AND ", $conditions);
        }

        $totalPosts = DB::select($countQuery, $params)[0]->total;
        $totalPages = ceil($totalPosts / $perPage);
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;

        $query .= " ORDER BY created_at DESC LIMIT ? OFFSET ?";
        $params[] = $perPage;
        $params[] = $offset;

        $allPosts = DB::select($query, $params);

        return view('home', [
            'username' => session('user'),
            'featuredPosts' => $featuredPosts,
            'posts' => $allPosts,
            'selectedCategory' => $selectedCategory,
            'selectedTag' => $selectedTag,
            'search' => $search,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }

    public function createForm()
    {
        if (!session('user')) {
            return redirect('/login')->withErrors(['access_denied' => 'Please login first.']);
        }

        return view('create', ['username' => session('user')]);
    }

    public function store(Request $request)
    {
        if (!session('user')) {
            return redirect('/login')->withErrors(['access_denied' => 'Please login first.']);
        }

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = 'uploads/' . time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imagePath);
        }

        DB::insert("INSERT INTO posts (title, body, image, category, tags, author, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())", [
            $request->title,
            $request->body,
            $imagePath,
            $request->category,
            implode(',', $request->tags),
            session('user'),
            'pending',
        ]);

        DB::insert("INSERT INTO activities (description, created_at) VALUES (?, NOW())", [
            session('user') . " requested a post",
        ]);

        return redirect('/home')->with('success', 'Post submitted for approval!');
    }

    public function storeComment(Request $request, $post_id)
    {
        if (!session('user')) {
            return redirect('/login')->withErrors(['access_denied' => 'Please login first.']);
        }

        $request->validate([
            'comment' => 'required',
        ]);

        DB::insert("INSERT INTO comments (post_id, author, comment, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())", [
            $post_id,
            session('user'),
            $request->comment,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    public function show($id)
    {
        if (!session('user')) {
            return redirect('/login')->withErrors(['access_denied' => 'Please login first.']);
        }

        $post = DB::select("SELECT * FROM posts WHERE id = ? AND status = 'published'", [$id]);

        if (!$post) {
            abort(404, 'Post not found or not published.');
        }

        $post = $post[0];

        $search = request()->query('search', '');

        return view('post', [
            'post' => $post,
            'username' => session('user'),
            'search' => $search,
        ]);
    }

    public function profile(Request $request)
    {
        if (!session('user')) {
            return redirect('/login')->withErrors(['access_denied' => 'Please login first']);
        }

        $username = session('user');
        $page = $request->query('page', 1);
        $perPage = 9;

        $query = "SELECT * FROM posts WHERE author = ?";
        $countQuery = "SELECT COUNT(*) as total FROM posts WHERE author = ?";
        $params = [$username];

        $totalPosts = DB::select($countQuery, $params)[0]->total;
        $totalPages = ceil($totalPosts / $perPage);
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;

        $query .= " ORDER BY created_at DESC LIMIT ? OFFSET ?";
        $params[] = $perPage;
        $params[] = $offset;

        $posts = DB::select($query, $params);

        return view('profile', [
            'username' => $username,
            'posts' => $posts,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }

    public function editPost($id){
        if(!session('user')){
            return redirect('/login')->withErrors(['access_denied' => 'Please login first']);
        }

        $post = DB::select("SELECT * FROM posts WHERE id = ? AND author = ?", [$id, session('user')]);

        if(!$post){
            return redirect('/profile')->withErrors(['error' => 'Unauthorized Access']);
        }

        return view('edit_post', ['post' => $post[0]], ['username' => session('user')]);
    }

    public function updatePost(Request $request, $id){
        if(!session('user')){
            return redirect('/login')->withErrors(['access_denied' => 'Please login first']);
        }

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        $post = DB::select("SELECT * FROM posts WHERE id = ? AND author = ?", [$id, session('user')]);

        if(!$post){
            return redirect('/profile')->withErrors(['error' => 'Unauthorized access']);
        }

        $imagePath = $post[0]->image;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imagePath = 'uploads/' . time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imagePath);
        }

        DB::update("UPDATE posts SET title = ?, body = ?, image = ?, updated_at = NOW() WHERE id = ?", [
            $request->title,
            $request->body,
            $imagePath,
            $id,
        ]);

        return redirect('/profile')->with('success', 'Post updated successfully');
    }

    public function deletePost($id){
        if(!session('user')){
            return redirect('/login')->withErrors(['access_denied' => 'Please login first']);
        }

        $post = DB::select("SELECT * FROM posts WHERE id = ? AND author = ?", [$id, session('user')]);

        if(!$post){
            return redirect('/profile')->withErrors(['error' => 'Unauthorized access']);
        }

        DB::delete("DELETE FROM posts WHERE id = ?", [$id]);

        return redirect('/profile')->with('success', 'Post deleted successfully');
    }

    public function userReportPost($id)
    {
        if (!session('user')) {
            return redirect('/login')->withErrors(['access_denied' => 'Please login to report a post.']);
        }

        $post = DB::select("SELECT * FROM posts WHERE id = ?", [$id]);
        if (!$post) {
            return redirect('/home')->withErrors(['error' => 'Post not found.']);
        }

        DB::insert("INSERT INTO reports (reported_by, reportable_id, reportable_type, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())", [
            session('user'),
            $id,
            'App\Models\Post',
        ]);

        DB::insert("INSERT INTO activities (description, created_at) VALUES (?, NOW())", [
            session('user') . " reported a post",
        ]);

        return back()->with('success', 'Post reported successfully.');
    }

    public function userReportComment($id)
    {
        if (!session('user')) {
            return redirect('/login')->withErrors(['access_denied' => 'Please login to report a comment.']);
        }

        $comment = DB::select("SELECT * FROM comments WHERE id = ?", [$id]);
        if (!$comment) {
            return redirect()->back()->withErrors(['error' => 'Comment not found.']);
        }

        DB::insert("INSERT INTO reports (reported_by, reportable_id, reportable_type, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())", [
            session('user'),
            $id,
            'App\Models\Comment',
        ]);

        DB::insert("INSERT INTO activities (description, created_at) VALUES (?, NOW())", [
            session('user') . " reported a comment",
        ]);

        return back()->with('success', 'Comment reported successfully.');
    }

/* ======================= ADMIN ======================= */
    public function adminLoginForm()
    {
        return view('administrator.admin-login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = trim($request->username);
        $password = trim($request->password);

        $admin = DB::select("SELECT * FROM admin WHERE username = ?", [$username]);

        if (!$admin || $password !== $admin[0]->password) {
            return back()->withErrors(['login_error' => 'Invalid admin username or password']);
        }

        session(['admin_user' => $admin[0]->username]);
        return redirect('/admin')->with('success', 'Admin login successful.');
    }

    public function adminLogout()
    {
        session()->forget('admin_user');
        return redirect('/admin/login')->with('success', 'Logged out successfully.');
    }

    public function admin(Request $request)
    {
        if (!session('admin_user')) {
            return redirect('/admin/login')->withErrors(['access_denied' => 'Please login as an admin first.']);
        }

        $totalUsers = DB::select("SELECT COUNT(*) as total FROM users")[0]->total;
        $totalPosts = DB::select("SELECT COUNT(*) as total FROM posts")[0]->total;
        $totalPendingPosts = DB::select("SELECT COUNT(*) as total FROM posts WHERE status = 'pending'")[0]->total;
        $totalReports = DB::select("SELECT COUNT(*) as total FROM reports")[0]->total;
        $users = DB::select("SELECT id, username FROM users");
        $activities = DB::select("SELECT description, created_at FROM activities ORDER BY created_at DESC LIMIT 6");

        $selectedYear = $request->input('year', date('Y'));
        $userRegistrations = DB::select("
            SELECT MONTHNAME(created_at) as month, MONTH(created_at) as month_number, COUNT(*) as count 
            FROM users WHERE YEAR(created_at) = ? 
            GROUP BY MONTHNAME(created_at), MONTH(created_at) 
            ORDER BY MONTH(created_at)", [$selectedYear]);
        $postCreations = DB::select("
            SELECT MONTHNAME(created_at) as month, MONTH(created_at) as month_number, COUNT(*) as count 
            FROM posts WHERE YEAR(created_at) = ? 
            GROUP BY MONTHNAME(created_at), MONTH(created_at) 
            ORDER BY MONTH(created_at)", [$selectedYear]);

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $usersPerMonth = array_fill(0, 12, 0);
        $postsPerMonth = array_fill(0, 12, 0);

        foreach ($userRegistrations as $registration) {
            $monthIndex = array_search($registration->month, $months);
            if ($monthIndex !== false) $usersPerMonth[$monthIndex] = $registration->count;
        }
        foreach ($postCreations as $post) {
            $monthIndex = array_search($post->month, $months);
            if ($monthIndex !== false) $postsPerMonth[$monthIndex] = $post->count;
        }

        $userYears = DB::select("SELECT DISTINCT YEAR(created_at) as year FROM users");
        $postYears = DB::select("SELECT DISTINCT YEAR(created_at) as year FROM posts");
        $years = array_unique(array_merge(array_column($userYears, 'year'), array_column($postYears, 'year')));
        sort($years, SORT_DESC);

        return view('administrator.dashboard', [
            'username' => session('admin_user') ?? 'Guest',
            'totalUsers' => $totalUsers,
            'totalPosts' => $totalPosts,
            'totalPendingPosts' => $totalPendingPosts,
            'totalReports' => $totalReports,
            'users' => $users,
            'activities' => $activities,
            'usersPerMonth' => $usersPerMonth,
            'postsPerMonth' => $postsPerMonth,
            'months' => $months,
            'selectedYear' => $selectedYear,
            'years' => $years,
        ]);
    }

    public function pendingPosts(Request $request)
    {
        if (!session('admin_user')) {
            return redirect('/admin/login')->withErrors(['access_denied' => 'Please login as an admin first.']);
        }

        $page = $request->query('page', 1);
        $perPage = 10;

        $query = "SELECT * FROM posts WHERE status = 'pending' ORDER BY created_at DESC";
        $countQuery = "SELECT COUNT(*) as total FROM posts WHERE status = 'pending'";

        $totalPosts = DB::select($countQuery)[0]->total;
        $totalPages = ceil($totalPosts / $perPage);
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;

        $query .= " LIMIT ? OFFSET ?";
        $posts = DB::select($query, [$perPage, $offset]);

        return view('administrator.pending-posts', [
            'username' => session('admin_user') ?? 'Guest',
            'posts' => $posts,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }

    public function publishPost($id)
    {
        if (!session('admin_user')) {
            return redirect('/admin/login')->withErrors(['access_denied' => 'Please login as an admin first.']);
        }

        DB::update("UPDATE posts SET status = 'published' WHERE id = ?", [$id]);
        DB::insert("INSERT INTO activities (description, created_at) VALUES (?, NOW())", [
            "You approved a post",
        ]);

        return redirect('/admin/pending-posts')->with('success', 'Post published successfully.');
    }

    public function adminDeletePost($id)
    {
        if (!session('admin_user')) {
            return redirect('/admin/login')->withErrors(['access_denied' => 'Please login as an admin first.']);
        }

        DB::delete("DELETE FROM posts WHERE id = ?", [$id]);
        DB::insert("INSERT INTO activities (description, created_at) VALUES (?, NOW())", [
            "You deleted a post",
        ]);

        return redirect('/admin/pending-posts')->with('success', 'Post deleted successfully.');
    }

    public function users(Request $request)
    {
        if (!session('admin_user')) {
            return redirect('/admin/login')->withErrors(['access_denied' => 'Please login as an admin first.']);
        }

        $search = $request->query('search');
        $status = $request->query('status');
        $page = $request->query('page', 1);
        $perPage = 10;

        $query = "SELECT * FROM users";
        $countQuery = "SELECT COUNT(*) as total FROM users";
        $params = [];
        $conditions = [];

        if ($search) {
            $conditions[] = "username LIKE ?";
            $params[] = "%$search%";
        }

        if ($status !== null) {
            $conditions[] = "is_banned = ?";
            $params[] = $status === 'banned' ? 1 : 0;
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
            $countQuery .= " WHERE " . implode(" AND ", $conditions);
        }

        $totalUsers = DB::select($countQuery, $params)[0]->total;
        $totalPages = ceil($totalUsers / $perPage);
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;

        $query .= " ORDER BY created_at DESC LIMIT ? OFFSET ?";
        $params[] = $perPage;
        $params[] = $offset;

        $users = DB::select($query, $params);

        foreach ($users as $user) {
            $user->post_count = DB::select("SELECT COUNT(*) as count FROM posts WHERE author = ?", [$user->username])[0]->count;
            $user->comment_count = DB::select("SELECT COUNT(*) as count FROM comments WHERE author = ?", [$user->username])[0]->count;
        }

        return view('administrator.users', [
            'username' => session('admin_user') ?? 'Guest',
            'users' => $users,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'search' => $search,
            'status' => $status,
        ]);
    }

    public function banUser($id)
    {
        if (!session('admin_user')) {
            return redirect('/admin/login')->withErrors(['access_denied' => 'Please login as an admin first.']);
        }

        $user = DB::select("SELECT * FROM users WHERE id = ?", [$id]);
        if (!$user) {
            return redirect('/admin/users')->withErrors(['error' => 'User not found.']);
        }

        DB::update("UPDATE users SET is_banned = 1 WHERE id = ?", [$id]);
        DB::insert("INSERT INTO activities (description, created_at) VALUES (?, NOW())", [
            "You banned user: {$user[0]->username}",
        ]);

        return redirect('/admin/users')->with('success', 'User banned successfully.');
    }

    public function unbanUser($id)
    {
        if (!session('admin_user')) {
            return redirect('/admin/login')->withErrors(['access_denied' => 'Please login as an admin first.']);
        }

        $user = DB::select("SELECT * FROM users WHERE id = ?", [$id]);
        if (!$user) {
            return redirect('/admin/users')->withErrors(['error' => 'User not found.']);
        }

        DB::update("UPDATE users SET is_banned = 0 WHERE id = ?", [$id]);
        DB::insert("INSERT INTO activities (description, created_at) VALUES (?, NOW())", [
            "You unbanned user: {$user[0]->username}",
        ]);

        return redirect('/admin/users')->with('success', 'User unbanned successfully.');
    }

    public function deleteUser($id)
    {
        if (!session('admin_user')) {
            return redirect('/admin/login')->withErrors(['access_denied' => 'Please login as an admin first.']);
        }

        $user = DB::select("SELECT * FROM users WHERE id = ?", [$id]);
        if (!$user) {
            return redirect('/admin/users')->withErrors(['error' => 'User not found.']);
        }

        if ($user[0]->username === session('admin_user')) {
            return redirect('/admin/users')->withErrors(['error' => 'You cannot delete your own account.']);
        }

        DB::delete("DELETE FROM users WHERE id = ?", [$id]);
        DB::insert("INSERT INTO activities (description, created_at) VALUES (?, NOW())", [
            "You deleted user: {$user[0]->username}",
        ]);

        return redirect('/admin/users')->with('success', 'User deleted successfully.');
    }

    public function reportPost($id)
    {
        if (!session('admin_user')) {
            return redirect('/admin/login')->withErrors(['access_denied' => 'Please login as an admin first.']);
        }

        $post = DB::select("SELECT * FROM posts WHERE id = ?", [$id]);
        if (!$post) {
            return redirect('/home')->withErrors(['error' => 'Post not found.']);
        }

        DB::insert("INSERT INTO reports (reported_by, reportable_id, reportable_type, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())", [
            session('admin_user'),
            $id,
            'App\Models\Post',
        ]);

        DB::insert("INSERT INTO activities (description, created_at) VALUES (?, NOW())", [
            session('admin_user') . " reported a post",
        ]);

        return back()->with('success', 'Post reported successfully.');
    }

    public function reportComment($id)
    {
        if (!session('admin_user')) {
            return redirect('/admin/login')->withErrors(['access_denied' => 'Please login as an admin first.']);
        }

        $comment = DB::select("SELECT * FROM comments WHERE id = ?", [$id]);
        if (!$comment) {
            return redirect()->back()->withErrors(['error' => 'Comment not found.']);
        }

        DB::insert("INSERT INTO reports (reported_by, reportable_id, reportable_type, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())", [
            session('admin_user'),
            $id,
            'App\Models\Comment',
        ]);

        DB::insert("INSERT INTO activities (description, created_at) VALUES (?, NOW())", [
            session('admin_user') . " reported a comment",
        ]);

        return back()->with('success', 'Comment reported successfully.');
    }

    public function reports(Request $request)
    {
        if (!session('admin_user')) {
            return redirect('/admin/login')->withErrors(['access_denied' => 'Please login as an admin first.']);
        }

        $page = $request->query('page', 1);
        $perPage = 10;

        $query = "SELECT * FROM reports ORDER BY created_at DESC";
        $countQuery = "SELECT COUNT(*) as total FROM reports";

        $totalReports = DB::select($countQuery)[0]->total;
        $totalPages = ceil($totalReports / $perPage);
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;

        $query .= " LIMIT ? OFFSET ?";
        $reports = DB::select($query, [$perPage, $offset]);

        foreach ($reports as $report) {
            if ($report->reportable_type === 'App\Models\Post') {
                $post = DB::select("SELECT * FROM posts WHERE id = ?", [$report->reportable_id]);
                $report->content = $post ? $post[0] : null;
                $report->type = 'Post';
            } elseif ($report->reportable_type === 'App\Models\Comment') {
                $comment = DB::select("SELECT * FROM comments WHERE id = ?", [$report->reportable_id]);
                $report->content = $comment ? $comment[0] : null;
                $report->type = 'Comment';
            }
        }

        return view('administrator.reports', [
            'username' => session('admin_user') ?? 'Guest',
            'reports' => $reports,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }

    public function managePosts(Request $request)
    {
        if (!session('admin_user')) {
            return redirect('/admin/login')->withErrors(['access_denied' => 'Please login as an admin first.']);
        }

        $page = $request->query('page', 1);
        $perPage = 10;

        $query = "
            SELECT 
                p.id, 
                p.title, 
                p.author, 
                p.created_at, 
                p.status,
                p.image,
                (SELECT COUNT(*) FROM comments c WHERE c.post_id = p.id) as comment_count
            FROM posts p
            ORDER BY p.created_at DESC
        ";
        $countQuery = "SELECT COUNT(*) as total FROM posts";

        $totalPosts = DB::select($countQuery)[0]->total;
        $totalPages = ceil($totalPosts / $perPage);
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;

        $query .= " LIMIT ? OFFSET ?";
        $posts = DB::select($query, [$perPage, $offset]);

        return view('administrator.manage-posts', [
            'username' => session('admin_user') ?? 'Guest',
            'posts' => $posts,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }

    public function deleteReport($id)
    {
        if (!session('admin_user')) {
            return redirect('/admin/login')->withErrors(['access_denied' => 'Please login as an admin first.']);
        }

        $report = DB::select("SELECT * FROM reports WHERE id = ?", [$id]);
        if (!$report) {
            return redirect('/admin/reports')->withErrors(['error' => 'Report not found.']);
        }

        DB::delete("DELETE FROM reports WHERE id = ?", [$id]);
        DB::insert("INSERT INTO activities (description, created_at) VALUES (?, NOW())", [
            "You resolved a report",
        ]);

        return redirect('/admin/reports')->with('success', 'Report resolved successfully.');
    }
}