@extends('partials.user_nav')

@section('content')
  <h2 class="brand-header">質問する</h2>

  <div class="container">
    {!! Form::open(['route' => 'question.confirm', 'method' => 'post']) !!}
      <h3 class="test">タイトル</h3>
        <div class="form-group {{ $errors->has('title')? 'has-error' : '' }}">
          {!! Form::text('title', null, ['class' => 'form-control']) !!}
          <span class="help-block">{{$errors->first('title')}}</span>
        </div>
      <h3>カテゴリ</h3>
        <div class="form-group {{ $errors->has('tag_category_id')? 'has-error' : '' }}">
          <select name='tag_category_id'　class = "form-control"　id =　"pref_id">
            <option value="">カテゴリ</option>
            @foreach($categories as $category)
            <option value= "{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
          <span class="help-block">{{$errors->first('tag_category_id')}}</span>
        </div>
      <h3 class="inline-block">質問内容</h3>
      <a class="markdown-paddingleft" href="#openModal">Markdownの書き方</a>
        <div class="form-group {{ $errors->has('content')? 'has-error' : '' }}">
          {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
          <span class="help-block">{{$errors->first('content')}}</span>
        </div>
        {!! Form::submit('確認', array('name' => 'create', 'class' => 'btn btn-success pull-right')) !!}
    {!! Form::close() !!}
    <div id="openModal" class="modalDialog">
      <div class="modalScroll">
        <a href="#close" title="Close" class="close">X</a>
        <table class="search-table contents">
          <div class="modal-header">
            Markdownの書き方
            <a class="markdownlink-header" target="_blank" href="https://daringfireball.net/projects/markdown/syntax">(もっと詳しく知りたい方はこちら)</a>
          </div>
          <ul class="markdown-nav paddingleft-none clearfix">
            <li>レイアウト</li>
            <li>装飾</li>
            <li>挿入</li>
          </ul>
          <tbody class="search-tbody">
            <tr class="border-botton">
              <td class="search-td markdownHelp_body">
                  <h1>見出し h1</h1>
                  <h2>見出し h2</h2>
                  <h3>見出し h3</h3>
                  <h4>見出し h4</h4>
                  <h5>見出し h5</h5>
                  <h6>見出し h6</h6>
              </td>
              <td class="search-td markdownHelp_body">
                <ul class="height-bodercode bodercode">
                  <li># 見出し h1</li>
                  <li>## 見出し h2</li>
                  <li>### 見出し h3</li>
                  <li>#### 見出し h4</li>
                  <li>##### 見出し h5</li>
                  <li>###### 見出し h6</li>
                </ul>
              </td>
            </tr>
            <tr class="border-botton">
              <td class="search-td markdownHelp_body">
                <ul class="paddingleft-none">
                  <li>リスト</li>
                  <li>リスト</li>
                  <ul>
                    <li>リスト</li>
                  </ul>
                </ul>
              </td>
              <td class="search-td markdownHelp_body">
                <ul class="list-bodercode bodercode">
                  <li>- リスト</li>
                  <li>- リスト</li>
                  <ul>
                    <li>- リスト</li>
                  </ul>
                </ul>
              </td>
            </tr>
            <tr class="border-botton">
              <td class="search-td markdownHelp_body">
                <ul class="paddingleft-none">
                  <li>
                    <input type="checkbox" class="task-list-item-checkbox" disabled="disabled" value="on">
                    チェックボックス
                  </li>
                  <li>
                    <input type="checkbox" checked class="task-list-item-checkbox" disabled="disabled" value="on">
                    チェックボックス
                  </li>
                </ul>
              </td>
              <td class="search-td markdownHelp_body">
                <ul class="list-bodercode bodercode">
                  <li>- [ ] チェックボックス</li>
                  <li>- [x] チェックボックス</li>
                </ul>
              </td>
            </tr>
            <tr class="border-botton">
              <td class="search-td markdownHelp_body">
                <ul class="paddingleft-none">
                  <li class="font-weight">リンゴ</li>
                  <li>赤いフルーツ</li>
                  <li class="font-weight">オレンジ</li>
                  <li>橙色フルーツ</li>
                </ul>
              </td>
              <td class="search-td markdownHelp_body">
                <div class="middle-bodercode bodercode">
                  <dl>
                    <dt>リンゴ</dt>
                    <dd>赤いフルーツ</dd>
                    <dt>オレンジ</dt>
                    <dd>橙色のフルーツ</dd>
                  </dl>
                </div>
              </td>
            </tr>
          </tbody>
          <tbody class="search-tbody is-hidden">
            <tr class="border-botton">
              <td class="search-td markdownHelp_body">
                強調（太字）
              </td>
              <td class="search-td markdownHelp_body">
                <div class="list-bodercode bodercode">
                  **text**
                </div>
              </td>
            </tr>
            <tr class="border-botton">
              <td class="search-td markdownHelp_body">
                強調（斜体）
              </td>
              <td class="search-td markdownHelp_body">
                <div class="list-bodercode bodercode">
                  *text*
                </div>
              </td>
            </tr>
            <tr class="border-botton">
              <td class="search-td markdownHelp_body">
                コードインラインの表示
              </td>
              <td class="search-td markdownHelp_body">
                <div class="list-bodercode bodercode">
                  `code`
                </div>
              </td>
            </tr>
            <tr class="border-botton">
              <td class="search-td markdownHelp_body">
                <ul class="paddingleft-none">
                  <div class="border-left">
                  <li>
                    引用
                  </li>
                  <li class="border-left-padding">
                    引用
                  </li>
                </div>
                </ul>
              </td>
              <td class="search-td markdownHelp_body">
                <div class="list-bodercode bodercode">
                  > text
                  >> text
                </div>
              </td>
            </tr>
          </tbody>
          <tbody class="search-tbody is-hidden">
            <tr class="border-botton">
              <td class="search-td markdownHelp_body">
                リンク
              </td>
              <td class="search-td markdownHelp_body">
                <div class="list-bodercode bodercode">
                  [title](http://...)
                </div>
              </td>
            </tr>
            <tr class="border-botton">
              <td class="search-td markdownHelp_body">
                画像埋め込み
              </td>
              <td class="search-td markdownHelp_body">
                <div class="list-bodercode bodercode">
                  ![alt](http://...)
                </div>
              </td>
            </tr>
            <tr class="border-botton">
              <td class="search-td markdownHelp_body">
                水平線
              </td>
              <td class="search-td markdownHelp_body">
                <div class="list-bodercode bodercode">
                  ---
                </div>
              </td>
            </tr>
            <tr class="border-botton">
              <td class="search-td markdownHelp_body">
                <div class="paddingleft-none">
                  <details><summary>折りたたみ</summary>内容を、detailsタグで囲みます。</details>
                </div>
              </td>
              <td class="search-td markdownHelp_body">
                <textarea class="list-bodercode bodercode" readonly="readonly"><details><summary>折りたたみ</summary>内容を、detailsタグで囲みます。</details>
                </textarea>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
$(function(){
    $('.markdown-nav').find('li').on('click', function() {
      var index = $(this).index();
      $('.contents')
        .find('tbody')
        .addClass('is-hidden')
        .eq(index)
        .removeClass('is-hidden');
    });
  });
  </script>

@endsection
