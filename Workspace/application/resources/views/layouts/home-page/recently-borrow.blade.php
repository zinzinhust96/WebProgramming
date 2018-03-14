<table class="table">
    <thead>
    <tr>
        <th class="table-cell">#</th>
        <th class="table-cell">Title</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($recentBooks as $book)
        <tr>
            <td class="table-cell">{{ $book->book_number }}</td>
            <td class="table-cell"><a href="{{ route('book.show', $book->id) }}">{{ $book->title }}</a></td>
        </tr>
    @endforeach
    </tbody>
</table>