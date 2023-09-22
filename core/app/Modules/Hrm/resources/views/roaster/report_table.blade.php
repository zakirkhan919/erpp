<table
                                                    class="table table-bordered text-nowrap border-bottom dataTable no-footer"
                                                    id="responsive-datatable" role="grid"
                                                    aria-describedby="responsive-datatable_info">
                                                    <thead>
                                                        <tr role="row">
                                                            
                                                            <th class="wd-15p border-bottom-0 sorting sorting_asc"
                                                                tabindex="0" aria-controls="responsive-datatable"
                                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                                aria-label="First name: activate to sort column descending"
                                                                style="width: 83.5729px;">Employee name</th>
                                                            <th class="wd-15p border-bottom-0 sorting" tabindex="0"
                                                                aria-controls="responsive-datatable" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Last name: activate to sort column ascending"
                                                                style="width: 77.1979px;">Start Time</th>
                                                            <th class="wd-20p border-bottom-0 sorting" tabindex="0"
                                                                aria-controls="responsive-datatable" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Position: activate to sort column ascending"
                                                                style="width: 159.417px;">Date</th>
                                                            <th class="wd-15p border-bottom-0 sorting" tabindex="0"
                                                                aria-controls="responsive-datatable" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Start date: activate to sort column ascending"
                                                                style="width: 80.8438px;">End Time</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $item)
                                                            <tr class="odd">
                                                                
                                                                <td class="sorting_1">{{ $item->employee->name }}</td>
                                                                <td>{{ $item->start_time }}</td>
                                                                <td>{{ $item->date }}</td>
                                                                <td>{{ $item->end_time }}</td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>