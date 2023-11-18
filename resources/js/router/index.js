import { createRouter, createWebHistory } from "vue-router";
import OrderView from '../components/OrderView.vue'
import AdminOrdersListView from '../components/OrdersListView.vue'

import NotFound from '../components/NotFound.vue'
import AdminLogin from '../components/AdminLogin.vue'

import AddProduct from '../components/Product/AddProduct.vue'
import ProductListView from '../components/Product/ProductListView.vue'
import EditProduct from '../components/Product/EditProduct.vue'

import AddCategory from '../components/Category/AddCategory.vue'
import CategoryListView from '../components/Category/CategoryListView.vue'
import EditCategory from '../components/Category/EditCategory.vue'

import AddSubCategory from '../components/SubCategory/AddSubCategory.vue'
import SubCategoryListView from '../components/SubCategory/SubCategoryListView.vue'
import EditSubCategory from '../components/SubCategory/EditSubCategory.vue'

const routes = [
    // {
    //     path:'/admin/admindashboard',
    //     component:DashBoardMain
    // },
    {
        path:'/admin/orderslist',
        component:AdminOrdersListView,
        meta: { requiresAuth: true },
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
    component:AddProduct,
    // only authenticated users can create posts
    meta: { requiresAuth: true },
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
    },
    {
    path:'/admin/add_category',
    name:'Add Category',
    component:AddCategory
    },
    {
      path:'/admin/category-list',
      name:'Category List',
      component:CategoryListView
    },
    {
    path:'/admin/view-category/:id/',
    name:'View Category',
    component:EditCategory
    },
    {
    path:'/admin/add_sub_category',
    name:'add Sub Category',
    component:AddSubCategory,
    },
    {
      path:'/admin/sub_category-list',
      name:'Sub Category List',
      component:SubCategoryListView
    },
    {
      path:'/admin/view-subcategory/:id/',
      name:'View Sub Category',
      component:EditSubCategory
    },
    {
    path:'/admin/authlogin',
    name:'Admin Login',
    component:AdminLogin
    }
]
const router = createRouter({
    history:createWebHistory(),
    routes
})

router.beforeEach((to, from) => {
    if (to.meta.requiresAuth && ! localStorage.getItem('token')) {

      return {
        path: '/admin/authlogin',
        // save the location we were at to come back later
        query: { redirect: to.fullPath },
      }
    }
    if(to.meta.requiresAuth == false && localStorage.getItem('token')) {
        return {
            path: '/admin/product-list',
            // save the location we were at to come back later
            query: { redirect: to.fullPath },
          }
    }
  })

export default router