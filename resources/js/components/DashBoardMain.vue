<template>
    <!-- <div class="vue_dashboard_main"> -->
        <AdminNavbar></AdminNavbar>
        <!-- <div class="container-fluid main-container"> -->
            <AdminLeftNav></AdminLeftNav>
            <AdminDashboardMain></AdminDashboardMain>
        <!-- </div> -->
        
    <!-- </div> -->
</template>

<script>
import AdminNavbar from './AdminNavbar.vue';
import AdminLeftNav from './AdminLeftNav.vue';
import AdminDashboardMain from './AdminDashboardMain.vue';
    export default {
        components: {
            AdminNavbar,
            AdminLeftNav,
            AdminDashboardMain,
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
