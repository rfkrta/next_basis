@include('head')
<div class="container">
    @include('sidebar')
<div class="main">
            <div class="main-top">
                <h1>Router</h1>
            </div>
            <div class="view">
                <div class="search">
                    <i class="fa fa-search"></i>
                    <input type="text" name="" class="input1" placeholder="Search">
                </div>
                <div class="plus">
                    <i class="fa fa-plus"></i>
                    <a href="TambahRouter.html">Tambah Router</a>
                </div>
            </div>
    
            <div class="cong-box">
                <div>
                    <table  class="box" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>MAC Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>00:1B:44:11:3A:B7</td>
                                <td>
                                    <a href="TambahKontrak.html" class="btn btn-danger">
                                        <i class="btn1 fa fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger">
                                        <i class="btn3 fa fa-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger">
                                        <i class="btn2 fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@include('script')