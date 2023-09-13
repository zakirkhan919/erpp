@extends('admin.common.master')
@section('title')
    <title>Roaster Manage</title>
@endsection
@section('css')
    <style>
        .roaster-button a {
            margin-right: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Roaster information</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Roaster info </li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div id="responsive-datatable_wrapper"
                                        class="dataTables_wrapper dt-bootstrap5 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12">
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
                                                                style="width: 83.5729px;">First name</th>
                                                            <th class="wd-15p border-bottom-0 sorting" tabindex="0"
                                                                aria-controls="responsive-datatable" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Last name: activate to sort column ascending"
                                                                style="width: 77.1979px;">Last name</th>
                                                            <th class="wd-20p border-bottom-0 sorting" tabindex="0"
                                                                aria-controls="responsive-datatable" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Position: activate to sort column ascending"
                                                                style="width: 159.417px;">Position</th>
                                                            <th class="wd-15p border-bottom-0 sorting" tabindex="0"
                                                                aria-controls="responsive-datatable" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Start date: activate to sort column ascending"
                                                                style="width: 80.8438px;">Start date</th>
                                                            <th class="wd-10p border-bottom-0 sorting" tabindex="0"
                                                                aria-controls="responsive-datatable" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Salary: activate to sort column ascending"
                                                                style="width: 58.1562px;">Salary</th>
                                                            <th class="wd-25p border-bottom-0 sorting" tabindex="0"
                                                                aria-controls="responsive-datatable" rowspan="1"
                                                                colspan="1"
                                                                aria-label="E-mail: activate to sort column ascending"
                                                                style="width: 165.417px;">E-mail</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="odd">
                                                            <td class="sorting_1">Adrian</td>
                                                            <td>Terry</td>
                                                            <td>Marketing Officer</td>
                                                            <td>2013/04/21</td>
                                                            <td>$543,769</td>
                                                            <td>a.terry@datatables.net</td>
                                                        </tr>
                                                        <tr class="even">
                                                            <td class="sorting_1">Angelica</td>
                                                            <td>Ramos</td>
                                                            <td>Chief Executive Officer</td>
                                                            <td>20017/10/15</td>
                                                            <td>$6,234,000</td>
                                                            <td>a.ramos@datatables.net</td>
                                                        </tr>
                                                        <tr class="odd">
                                                            <td class="sorting_1">Bella</td>
                                                            <td>Chloe</td>
                                                            <td>System Developer</td>
                                                            <td>2018/03/12</td>
                                                            <td>$654,765</td>
                                                            <td>b.Chloe@datatables.net</td>
                                                        </tr>
                                                        <tr class="even">
                                                            <td class="sorting_1">Brenden</td>
                                                            <td>Wagner</td>
                                                            <td>Software Engineer</td>
                                                            <td>2013/07/14</td>
                                                            <td>$206,850</td>
                                                            <td>b.wagner@datatables.net</td>
                                                        </tr>
                                                        <tr class="odd">
                                                            <td class="sorting_1">Bruno</td>
                                                            <td>Nash</td>
                                                            <td>Software Engineer</td>
                                                            <td>2015/05/03</td>
                                                            <td>$163,500</td>
                                                            <td>b.nash@datatables.net</td>
                                                        </tr>
                                                        <tr class="even">
                                                            <td class="sorting_1">Cameron</td>
                                                            <td>Watson</td>
                                                            <td>Sales Support</td>
                                                            <td>2013/9/7</td>
                                                            <td>$675,876</td>
                                                            <td>c.watson@datatables.net</td>
                                                        </tr>
                                                        <tr class="odd">
                                                            <td class="sorting_1">Connor</td>
                                                            <td>Johne</td>
                                                            <td>Web Developer</td>
                                                            <td>2011/1/25</td>
                                                            <td>$92,575</td>
                                                            <td>C.johne@datatables.net</td>
                                                        </tr>
                                                        <tr class="even">
                                                            <td class="sorting_1">Dominic</td>
                                                            <td>Hudson</td>
                                                            <td>Sales Assistant</td>
                                                            <td>2015/10/16</td>
                                                            <td>$654,300</td>
                                                            <td>d.hudson@datatables.net</td>
                                                        </tr>
                                                        <tr class="odd">
                                                            <td class="sorting_1">Donna</td>
                                                            <td>Bond</td>
                                                            <td>Account Manager</td>
                                                            <td>2012/02/21</td>
                                                            <td>$543,654</td>
                                                            <td>d.bond@datatables.net</td>
                                                        </tr>
                                                        <tr class="even">
                                                            <td class="sorting_1">Evan</td>
                                                            <td>Terry</td>
                                                            <td>Sales Manager</td>
                                                            <td>2013/10/26</td>
                                                            <td>$66,340</td>
                                                            <td>d.terry@datatables.net</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endsection
