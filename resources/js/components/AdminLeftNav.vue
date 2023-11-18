<template>
    <div class="col-md-2 sidebar">
        <div class="row">
            <!-- uncomment code for absolute positioning tweek see top comment in css -->
            <div class="absolute-wrapper"> </div>
            <!-- Menu -->
            <div class="side-menu">
                <nav class="navbar navbar-default" role="navigation">
                    <!-- Main Menu -->
                    <div class="side-menu-container">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="/admin/admindashboard"><span
                                        class="glyphicon glyphicon-dashboard"></span>
                                    Dashboard</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-plane"></span> Active Link</a>

                            </li>
                            <li>
                                <router-link to="/admin/orderslist"><span class="glyphicon glyphicon-shopping-cart"></span>
                                    Orderlist</router-link>
                            </li>
                            <li><a href="#"><span class="glyphicon glyphicon-cloud"></span> Link</a></li>

                            <!-- Products -->
                            <li class="panel panel-default" id="dropdown">
                                <a data-toggle="collapse" href="#dropdown-lvl1">
                                    <span class="glyphicon glyphicon-gift"></span>Products<span class="caret"></span>
                                </a>

                                <!-- Dropdown level 1 -->
                                <div id="dropdown-lvl1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li>
                                                <router-link to="/admin/add_product"><span
                                                        class="glyphicon glyphicon-shopping-cart"></span> Add
                                                    Product</router-link>
                                            </li>
                                            <li>
                                                <router-link to="/admin/product-list"><span
                                                        class="glyphicon glyphicon-zoom-in"></span> View
                                                    Products</router-link>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- Category -->
                            <li class="panel panel-default" id="dropdown">
                                <a data-toggle="collapse" href="#dropdown-lvl2">
                                    <span class="glyphicon glyphicon-list"></span>Category<span class="caret"></span>
                                </a>

                                <!-- Dropdown level 1 -->
                                <div id="dropdown-lvl2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li>
                                                <router-link to="/admin/add_category"><span
                                                        class="glyphicon glyphicon-shopping-cart"></span> Add
                                                    Category</router-link>
                                            </li>
                                            <li>
                                                <router-link to="/admin/category-list"><span
                                                        class="glyphicon glyphicon-shopping-cart"></span> View
                                                    Category</router-link>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!--Sub Category -->
                            <li class="panel panel-default" id="dropdown">
                                <a data-toggle="collapse" href="#dropdown-lvl3">
                                    <span class="glyphicon glyphicon-list-alt"></span>Sub Category<span class="caret"></span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="dropdown-lvl3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li>
                                                <router-link to="/admin/add_sub_category"><span
                                                        class="glyphicon glyphicon-shopping-cart"></span> Add
                                                    SubCategory</router-link>
                                            </li>
                                            <li>
                                                <router-link to="/admin/sub_category-list"><span
                                                        class="glyphicon glyphicon-shopping-cart"></span> View
                                                        SubCategory</router-link>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="#"><span class="glyphicon glyphicon-signal"></span> Link</a></li>

                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
