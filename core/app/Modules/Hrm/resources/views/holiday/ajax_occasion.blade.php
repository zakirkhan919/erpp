<table class="table table-inbox table-hover text-nowrap mb-0">
    <thead>
        <tr class="">
            <td class="inbox-small-cells">Sl</td>
            <td class="inbox-small-cells">Day</td>
            <td
                class="view-message dont-show fw-semibold clickable-row">
                Occasion</td>
            <td class="view-message clickable-row">Description</td>
            <td class="view-message text-end fw-semibold clickable-row">
                Action</td>
        </tr>

    </thead>
    <tbody>
        @foreach ($occasionHoliday as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}({{ \Carbon\Carbon::parse($item->date)->format('l') }})
                </td>
                <td>{{ $item->occasion }}</td>
                <td>{{ $item->description }}</td>
                <td><button
                        class="btn btn-info" type="button" onclick="occasionEdit({{$item->id}})">Edit</button>&nbsp;&nbsp;<button
                        class="btn btn-danger" type="button" onclick="occasionDelete({{ $item->id }})">Delete</button></td>
            </tr>
        @endforeach
    </tbody>
</table>