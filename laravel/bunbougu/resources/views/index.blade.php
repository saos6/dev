
@extends('app')
  
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="text-right">
                <h2 style="font-size:1rem;">ログイン者：{{ $user_name }}</h2>
              </div>
            <div class="text-left">
                <h2 style="font-size:1rem;">文房具マスター</h2>
            </div>
            <div class="text-right">
                @auth
                <a class="btn btn-success" href="{{ route('bunbougu.create') }}">新規登録</a>
                @endauth
            </div>
        </div>
    </div>
    <table class="table table-bordered">
      <tr>
          <th>No</th>
          <th>name</th>
          <th>kakaku</th>
          <th>bunrui</th>
          <th></th>
          <th></th>
          <th>編集者</th>
      </tr>
      @foreach ($bunbougus as $bunbougu)
      <tr>
          <td style="text-align:right">{{ $bunbougu->id }}</td>
          {{-- <td>{{ $bunbougu->name }}</td> --}}
          {{-- <td><a href="{{ route('bunbougu.show',$bunbougu->id) }}">{{ $bunbougu->name }}</a></td> --}}
          <td><a href="{{ route('bunbougu.show',$bunbougu->id) }}?page_id={{ $page_id }}">{{ $bunbougu->name }}</a></td>
          <td style="text-align:right">{{ $bunbougu->kakaku }}円</td>
          <td>{{ $bunbougu->bunrui }}</td>
          <td style="text-align:center">
            @auth
            <a class="btn btn-primary" href="{{ route('bunbougu.edit',$bunbougu->id) }}">変更</a>
            @endauth
          </td>
          <td style="text-align:center">
            <form action="{{ route('bunbougu.destroy',$bunbougu->id) }}" method="POST">
            @csrf
            @method('DELETE')
            @auth
            <button type="submit" class="btn btn-sm btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
            @endauth
            </form>
          </td>
          <td>{{ $bunbougu->user->name }}</td>
      </tr>
      @endforeach
  </table>

  {!! $bunbougus->links('pagination::bootstrap-5') !!}
@endsection
