<h1>
  {{ $search_site }}
</h1>
<table class="table">
    <thead>
      <tr>
        <th scope="col w-10">#</th>
        <th scope="col w-20">Tag-Name</th>
        <th scope="col w-70">How Much Appears</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($tags as $tag)
        <tr>
          <th scope="row">{{ $tag->index }}</th>
          <td>{{ $tag->name }}</td>
          <td>{{ $tag->how_much }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>