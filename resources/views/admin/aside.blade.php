<!-- Main Sidebar Container -->

<style>
.sidebar_bar{
    background-color: rgba(5,4,9,0.89)

}
p{
    color: white;
}

.nav-item:hover{
    background-color: #8e0814;
}
</style>

<aside class="main-sidebar sidebar_bar elevation-5">
    <!-- Brand Logo -->
    <a href="/main" class="brand-link text-center ">
        <img  src="{{asset('logo/logo.jpeg')}}" alt="AdminLTE Logo" class="brand-image img-circle"
             style="opacity: .7">
        <span class="brand-text font-weight-light text-danger">Ladies Shop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="/category" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            الفئات
                            <span class="right badge badge-danger"><i class="fa fa-plus-circle"></i><i class="fa fa-eye"></i></span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/category/create" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            إضافة فئات
                            <span class="right badge badge-danger"><i class="fa fa-plus-circle"></i></span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/product" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            جرد المخزن
                            <span class="right badge badge-danger"><i class="fa fa-plus-circle"></i><i class="fa fa-eye"></i>  </span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/product/create" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            إضافة منتجات
                            <span class="right badge badge-danger"><i class="fa fa-plus-circle"></i></span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/orders" class="nav-link">
                        <i class="nav-icon fas fa-money-check"></i>
                        <p>
                            الأوردرات
                            <span class="right badge badge-danger"><i class="fa fa-eye"></i>  </span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/report" class="nav-link">
                        <i class="nav-icon fas fa-money-check"></i>
                        <p>
                            تقارير
                            <span class="right badge badge-danger"><i class="fa fa-eye"></i>  </span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-money-check"></i>
                        <p>
                            صفحة المبيعات
                            <span class="right badge badge-danger"><i class="fa fa-eye"></i>  </span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/emp" class="nav-link">
                        <i class="nav-icon fas fa-money-check"></i>
                        <p>
                            الموظفين 
                            <span class="right badge badge-danger"><i class="fa fa-plus-circle"></i><i class="fa fa-eye"></i>  </span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/sup" class="nav-link">
                        <i class="nav-icon fas fa-money-check"></i>
                        <p>
                            الموردين 
                            <span class="right badge badge-danger"><i class="fa fa-plus-circle"></i><i class="fa fa-eye"></i>  </span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/net" class="nav-link">
                        <i class="nav-icon fas fa-money-check"></i>
                        <p>
                            المصروفات الخارجية 
                            <span class="right badge badge-danger"><i class="fa fa-eye"></i>  </span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/cust_orders" class="nav-link">
                        <i class="nav-icon fas fa-money-check"></i>
                        <p>
                            أوردرات العملة 
                            <span class="right badge badge-danger"><i class="fa fa-eye"></i>  </span>
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
