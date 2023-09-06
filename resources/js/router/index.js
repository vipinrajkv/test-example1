import { createRouter, createWebHistory } from "vue-router";
import OrderView from '../components/OrderView.vue'
import AdminOrdersListView from '../components/OrdersListView.vue'

import NotFound from '../components/NotFound.vue'
import AddProduct from '../components/Product/AddProduct.vue'
import ProductListView from '../components/Product/ProductListView.vue'
import EditProduct from '../components/Product/EditProduct.vue'

const routes = [
    // {
    //     path:'/admin/admindashboard',
    //     component:DashBoardMain
    // },
    {
        path:'/admin/orderslist',
        component:AdminOrdersListView
    },
    {
    path:'/admin/:pathMatch(.*)*',
    component:NotFound
    },
    {
    path:'/admin/view_order/:id/',
    name:'viewOrder',
    component:OrderView
    },
    {
    path:'/admin/add_product',
    name:'addProduct',
    component:AddProduct
    },
    {
    path:'/admin/product-list',
    name:'product List',
    component:ProductListView
    },
    {
    path:'/admin/view-product/:id/',
    name:'View Product',
    component:EditProduct
    }
]
const router = createRouter({
    history:createWebHistory(),
    routes
})

export default router