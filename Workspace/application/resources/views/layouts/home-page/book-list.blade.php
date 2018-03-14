<table class="table">
    <thead>
    <tr>
        <th class="table-cell">#</th>
        <th class="table-cell">Title</th>
        <th class="table-cell">Authors</th>
        <th class="table-cell">Publisher</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($books as $book)
        <tr>
            <td class="table-cell">{{ $book->book_number }}</td>
            <td class="table-cell"><a href="#">{{ $book->title }}</a></td>
            <td class="table-cell">{{ $book->authors }}</td>
            <td class="table-cell">{{ $book->publisher }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div style="float: right;">
    {{ $books->links() }}
</div>