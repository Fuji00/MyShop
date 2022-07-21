<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Category;
use App\Order;
use App\Like;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemImageRequest;
use App\Services\FileUploadService;
use Illuminate\Pagination\LengthAwarePaginator;

class ItemController extends Controller
{
    public function __construct(){
       $this->middleware('auth');
       
    }
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $items=Item::where('user_id','!=',\Auth::user()->id)->get();//paginate(1);
        $query=Item::query();
        $user=\Auth::user();
        $category=Category::all();

        
        
        //検索ワード受け取り
        /*
        $keywords_main='';
        if(isset($request->keyword[0])) $keywords_main=$request->keywords[0];
        $keywords_add='';
        if(isset($request->keyword[1])) $keywords_add=$request->keywords[1];
        */

        $keywords_main=$request->input('keywords_main');
        $keywords_add=$request->input('keywords_add');
        $keyword_category=$request->input('category_id');
        $keyword_price_more=$request->input('price_more');
        $keyword_price_less=$request->input('price_less');
        $keyword_sort=$request->input('sort_id');

    //何も検索されていなければじぶんのID 以外のが表示される
    
        if($keyword_sort==='asc'){
            //新着順
            //$items=Item::where('user_id','!=',\Auth::user()->id)->latest()->get();
            //$items=$items->sortBy('created_at')->values();
            //$query->sortBy('created_at');//->values();
            $query->where('user_id','!=',\Auth::user()->id)->latest('created_at');
            
        }else if($keyword_sort==='desc'){
            //投稿順
            //$items=Item::where('user_id','!=',\Auth::user()->id)->oldest()->get();
            //$items=$items->sortByDesc('created_at')->values();
            //$query->sortByDesc('created_at');//->values();
            $query->where('user_id','!=',\Auth::user()->id)->oldest('created_at');
            
        }else{
            $query->where('user_id','!=',\Auth::user()->id)->latest('created_at');
            
        }
       
    //商品名　説明欄　検索
        if(isset($keywords_main)){
            //$items=Item::search($request->keywords)->where('user_id','!=',\Auth::user()->id)->latest()->paginate(1); 
            
                $query->where('name','LIKE',"%{$keywords_main}%");   
        }
        if(isset($keywords_add)){
            //$items=Item::search($request->keywords)->where('user_id','!=',\Auth::user()->id)->latest()->paginate(1); 
                $query->where('name','LIKE',"%{$keywords_add}%");   
        }
        /*else{
            //dd($request->keywords);
            $items=Item::where('user_id','!=',\Auth::user()->id)->latest()->paginate(1);
        }*/
       
    //カテゴリ絞り込み
        if(isset($keyword_category/*$request->category_id*/)){
            if($keyword_category!=0){
                $query->where('category_id',$keyword_category);
            }
            //$items=$items->where('category_id',$request->category_id);
            /*
            $items = new LengthAwarePaginator(
                $items->forPage($request->page, 1),
                count($items),
                1,//3ページ以上なら次のページのボタンが表示される？
                $request->page,
                array('path' => $request->url()),
                
            );*/
        }
        //dd($query);
    //価格指定
        if(isset($keyword_price_more/*$request->price_more*/)){//指定した価格以上
            //$items=$items->where('price','>=',$request->price_more);
            $query->where('price','>=',$keyword_price_more);
            //$items=$query->paginate(1);
        }
        if(isset($keyword_price_less/*$request->price_less*/)){//指定した価格以下
            //$items=$items->where('price','<=',$request->price_less);
            $query->where('price','<=',$keyword_price_less);
            //$items=$query->paginate(1);

        }
        
    
        /*
        $user=\Auth::user();
        //$items=Item::where('user_id','!=',\Auth::user()->id)->latest()->paginate(9);
        $category=Category::all();
        $choiceCategory=$request->category_id;
        $choiceSort=$request->sort_id;
        */
        $items=$query->where('user_id','!=',\Auth::user()->id)->paginate(9);
        //$items->where('user_id','!=',\Auth::user()->id);
       
        return view('items.index',[
            'title'=>'トップページ',
            'items'=>$items,
            'user'=>$user,
            'keywords_main'=>$keywords_main,//$request->keywords,
            'keywords_add'=>$keywords_add,
            'categories'=>$category,
            'choiceCategoty'=>$keyword_category,//$choiceCategory,
            'price_more'=>$keyword_price_more,//$request->price_more,
            'price_less'=>$keyword_price_less,//$request->price_less,
            'choiceSort'=>$keyword_sort,//$choiceSort,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('items.create',[
            'title'=>'商品を出品',
            'categories'=>$categories,
        ]);
    }

   
   
   //新規出品用のstore
    public function store(ItemRequest $request , ItemImageRequest $request_image,FileUploadService $service){
        $user=\Auth::user();
        
        $path=$service->saveImage($request->file('image'));
        
        Item::create([
            'user_id'=>$user->id,
            'name'=>$request->name,
            'description'=>$request->description,
            'category_id'=>$request->category_id,
            'price'=>$request->price,
            'image'=>$path,
        ]);
       
       
       session()->flash('success', '商品を出品しました');
        return redirect()->route('users.exhibitions',$user);
    }
   
   
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//出品情報編集
    public function edit($id)
    {
        
        $user=\Auth::user();
        $item=Item::find($id);
        $categories=Category::all();
        return view('items.edit',[
            'title'=>'商品情報編集',
            'user'=>$user,
            'item'=>$item,
            'categories'=>$categories,
        ]);
    }
    
    public function update(ItemRequest $request,$id){
        $item=Item::find($id);
        $item->update($request->only([
            'name','description','price','category_id',
            
        ]));
        session()->flash('success', '商品情報を更新しました');
        return redirect()->route('items.show',$id);
    }
    
    
    
    
    

    public function edit_image($id){
        
        $item=Item::find($id);
        
        return view('items.edit_image',[
            'title'=>'商品画像変更',
            'item'=>$item,
        ]);
    }
    public function update_image(ItemImageRequest $request,$id,FileUploadService $service){
      
        $path=$service->saveImage($request->file('image'));
        //変更前の画像を削除
        $item=Item::find($id);
         if($item->image !== ''){
           \Storage::disk('public')->delete($item->image);
        }
        $item->update([// ファイル名を保存
            'image'=>$path,   
        ]);
        session()->flash('success', '商品の画像を変更しました');
        return redirect()->route('items.show',$id);
    }
    
    
    //出品商品を消す
    public function destroy($id){
        $item=Item::find($id);
        
        if($item->image !== ''){
            \Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        session()->flash('success', '商品を削除しました');
        return redirect()->route('users.exhibitions',\Auth::user());
    }
    
    
    
    
    
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=\Auth::user();
        $item=Item::find($id);//コレはテーブルから1つとる
        $category=$item->category;
        //$sold_out_item=Order::where('item_id',$id)->count();

        return view('items.show',[
            'title'=>'商品詳細',
            'user'=>$user,
            'item'=>$item,
            'category'=>$category,
        //    'sold_out_item'=>$sold_out_item,
        ]);
    }
    public function confirm_store($id){
        $user=\Auth::user();
       
        return redirect()->route('items.confirm',$id);
    }
    public function confirm($id)
    {
        $user=\Auth::user();
        $item=Item::find($id);
        $category=$item->category;
        return view('items.confirm',[
            'title'=>'購入確認画面',
            'user'=>$user,
            'item'=>$item,
            'category'=>$category,
        ]);
    }
    
    
    public function finish_store($id){//configとfinishの間のヤツpost
        $user=\Auth::user();
        $item=Item::find($id);
        //dd($item);
        Order::create([
            'user_id'=>$user->id,
            'item_id'=>$item->id,
        ]);
       
       
       session()->flash('success', '商品を購入しました');
        return redirect()->route('items.finish',$id);
    }
    public function finish($id)//購入完了画面get
    {
        $user=\Auth::user();
        $item=Item::find($id);
        $category=$item->category;
        return view('items.finish',[
            'title'=>'ご購入ありがとうございました。',
            'user'=>$user,
            'item'=>$item,
            'category'=>$category,
        ]);
    }


    
    public function toggleLike($id){
        $user=\Auth::user();
        $item=Item::find($id);
        if($item->isLikedBy($user)){
            //いいねの取り消し
            $item->likes->where('user_id',$user->id)->first()->delete();
            session()->flash('success', 'いいねを取り消しました');
            
        }else{
            //いいねを設定
            Like::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
            ]);
            session()->flash('success', 'いいねしました');
            
        }
        return response()->json(['liked' => true]);//redirect()->route('home');
    }
    
    public function likeTest($id){
        //$result = $request->all();
        $user=\Auth::user();
        $item=Item::find($id);
        if($item->isLikedBy($user)){
            //いいねの取り消し
            $item->likes->where('user_id',$user->id)->first()->delete();
            session()->flash('success', 'いいねを取り消しました');
            return response()->json([
                                        'liked' => false,
                                        //'item_id'=>$item->id,
                                    ]);
        }else{
            //いいねを設定
            Like::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
            ]);
            session()->flash('success', 'いいねしました');
            return response()->json([
                                        'liked' => true,
                                        //'item_id'=>$item->id,
                                    ]);
        }
    }
     
    
}
