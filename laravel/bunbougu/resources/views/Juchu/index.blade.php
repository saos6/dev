
@extends('app')
  
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="text-right">
                <h2 style="font-size:1rem;">ログイン者：{{ $user_name }}</h2>
              </div>
            <div class="text-left">
                <h2 style="font-size:1rem;">受注入力</h2>
            </div>
            <div class="text-right">
                @auth
                <a class="btn btn-success" href="{{ route('juchu.create') }}">新規登録</a>
                @endauth
            </div>
        </div>
    </div>
    <table class="table table-bordered">
      <tr>
          <th>Id</th>
          <th>客先</th>
          <th>文房具</th>
          <th>個数</th>
          <th>状態</th>
          <th>更新ユーザー</th>
          <th></th>
          <th></th>
      </tr>
      @foreach ($juchus as $juchu)
      <tr>
        <td style="text-align:right">{{ $juchu->id }}</td>
        <td>{{ $juchu->kyakusaki_name }}</td>
        <td>{{ $juchu->bunbougu_name }}</td>
        <td style="text-align:center">{{ $juchu->kosu }}個</td>
        <td>{{ $juchu->joutai }}</td>
        <td>{{ $juchu->user_name }}</td>
        <td style="text-align:center">
            @auth
            <a class="btn btn-sm btn-primary" href="{{ route('juchu.edit',$juchu->id) }}">
            変更
            </a>
            @endauth
        </td>
        <td style="text-align:center">
            @auth
            <form action="{{ route('juchu.destroy',$juchu->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
            </form>
            @endauth
        </td>
      </tr>
      @endforeach
  </table>

  {!! $juchus->links('pagination::bootstrap-5') !!}
@endsection
