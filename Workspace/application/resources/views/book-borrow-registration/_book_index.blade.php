<div class="row" id="ajax-pagination">
    {{ $books->links('layouts.ajax-pagination') }}
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
            <tr>
                <th class="table-cell">Book number</th>
                <th class="table-cell">Title</th>
                <th class="table-cell">Authors</th>
                <th class="table-cell">Publisher</th>
                <th class="table-cell">Number of Available Copies</th>
                <th class="table-cell"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($books as $book)
                <tr>
                    <td class="table-cell">{{ $book->book_number }}</td>
                    <td class="table-cell"><a href="{{ route('book.show', $book->id) }}">{{ $book->title }}</a></td>
                    <td class="table-cell">{{ $book->authors }}</td>
                    <td class="table-cell">{{ $book->publisher }}</td>
                    <td class="table-cell">{{ $book->numberOfAvailableCopies() }}</td>
                    <td class="table-cell">
                        @if($book->numberOfAvailableCopies() > 0)
                            <input type="checkbox" class="book-selector" value="{{ $book->id }}">
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
