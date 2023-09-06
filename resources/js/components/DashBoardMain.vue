<template>
    <div class="vue_dashboard_main">
        <AdminNavbar></AdminNavbar>
        <div class="container-fluid main-container">
            <AdminLeftNav></AdminLeftNav>
            <!-- <AdminDashboardPanel></AdminDashboardPanel> -->
            <!-- <AdminOrdersListView></AdminOrdersListView> -->
            <router-view></router-view>
        </div>
        
    </div>
</template>

<script>
import AdminNavbar from './AdminNavbar.vue';
import AdminLeftNav from './AdminLeftNav.vue';
import AdminDashboardPanel from './AdminDashboardPanel.vue'
// import AdminOrdersListView from './OrdersListView.vue'
import { RouterView } from 'vue-router';



    export default {
        components: {
    AdminNavbar,
    AdminLeftNav,
    AdminDashboardPanel,
    //      AdminOrdersListView,
    RouterView
},
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
