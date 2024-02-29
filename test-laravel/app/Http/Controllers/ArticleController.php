<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use DragonCode\Contracts\Cashier\Auth\Auth;
//use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        //index,show 메서드 auth 미들웨어 적용 제외
        $this->middleware('auth')->except(['index','show']);
    }
    
    public function index(Request $request){
         //$page = $request->input('page', 1);
        $perPage = $request->input('per_page', 5);
        //$skip = ($page-1) * $perPage;

        $articles = Article::with('user')
        //->select('user_id','content','created_at')
        ->orderby('created_at', 'desc')
        ->paginate($perPage);

        //시간계산
        //dd(Carbon::now()->addHour(2));
        /*
        $results = DB::table('articles as a')->join('users as u', 'a.user_id', '=', 'u.id')
        ->select('a.*', 'u.name')
        ->latest()
        ->paginate();
        */


        $totalCount = Article::count();
        //return view('articles.index', ['articles' => $articles]);
        return view('articles.index', ['articles'=>$articles,
                                        'totalCount'=>$totalCount,
                                        'perPage'=>$perPage
                                        ]);
    }

    public function create(){
        return view('/articles/create');
    }


    public function store(Request $request){
        $article = new Article;
        //Laravel 유효성검사 제공기능(메뉴얼 참조)
        $input = $request->validate([
            'content'=>[
                'required',
                'string',
                'max:30'
            ]
        ]);

        //유효성검사
        /*
        $data = $_POST['content'];
        if(!$data){
            return redirect()->back();
        }
        if(!is_string($data)){
            return redirect()->back();
        }
        if(!strlen($data) > 255){
            return redirect()->back();
        }
        */

        $content = $request->input('content');
        //$user_id = $request->input('user_id');
        $user_id = 1; 
        //dd($request->collect());


        //데이터 저장(php)=> pdo객체생성 > 쿼리준비 > 쿼리값 설정 > 실핼
        /*
        $host = config('database.connections.mysql.host');
        $port = config('database.connections.mysql.port');
        $dbname = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');

        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);

        $stmt = $conn->prepare("INSERT INTO articles (content, user_id, created_at, updated_at) VALUES(:content, :user_id, :created_at, :updated_at)");

        $stmt->bindValue(':content',$input['content']);
        //$stmt->bindValue(':user_id', $request->user()->id);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':created_at', null);
        $stmt->bindValue(':updated_at', null);

        $stmt->execute();
        */


        //데이터 저장(Laravel 파사드 사용)
        //DB::statement("INSERT INTO articles (content, user_id) VALUES(:content, :user_id)", [$input['content'], $user_id]);

        //데이터 저장(쿼리빌더 사용)
        /*
        DB::table('articles')->insert([
            'content'=>$input['content'],
            'user_id'=>$user_id
        ]);
        */

        //데이터 저장(Eloquent ORM 사용)
        $article = new Article;
        $article->content = $input['content'];
        $article->user_id = 1;
        $article->save();


        return redirect()->route('article.index');
    }


    public function show($id){
        $data = Article::find($id);
        //dd($data);

        return view('articles.show', ['data'=>$data]);
    }

    public function edit($id){
        $data = Article::find($id);
        return view('articles.edit', ['data'=>$data]);
    }

    public function update(Request $request){
        $input = $request->validate([
            'content'=>[
                'required',
                'string',
                'max:30'
            ]
        ]);
    
        //$article->content = $input['content'];
        $article = Article::find($request->id);
        $article->content = $request->content;
        $article->save();
    
        return redirect()->route('article.index');
    }

    public function delete($id){
        $article = Article::find($id);
        $article->delete();
        return redirect()->route('article.index');
    }


}
