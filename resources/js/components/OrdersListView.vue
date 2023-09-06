<template>
   			  <div class="col-md-10">
                <h1>Order List</h1>
                
				  <div class="panell">
					  
					  <div class="panell-body table-responsive">
						  <table class="table">
							  <thead>
								  <tr>
									  <th>#</th>
									  <th>Name</th>
									  <th>Trucking Number</th>
									  <th>Payment Type</th>
									  <th>Actions</th>
								  </tr>
							  </thead>
							  <tbody>
								  <tr v-for="(order, index) in orders" :key="index" >
									  <td> {{ order.id }} </td>
									  <td> {{ order.name }} </td>
									  <td>{{ order.trucking_number }}</td>
									  <td> {{ order.payment_mode }} </td>
									  <td>
										<ul class="action-list">
											<li><RouterLink :to="{path:'/admin/view_order/'+order.id+''}" class="btn btn-primary"><i class="fa fa-search"></i></RouterLink></li>
											<li><a href="#" class="btn btn-danger"><i class="fa fa-times"></i></a></li>
											<li><a href="#" class="btn btn-sm btn-success"><i class="fa fa-search"></i></a></li>
										</ul>
                                      </td>
								  </tr>
								  
							  </tbody>
						  </table>
					  </div>
					  <div class="panell-footer">
						  <div class="row">
							  <div class="col-sm-6 col-xs-6">showing <b>5</b> out of <b>25</b> entries</div>
							  <div class="col-sm-6 col-xs-6">
								  <ul class="pagination hidden-xs pull-right">
									  <li><a href="#">«</a></li>
									  <li class="active"><a href="#">1</a></li>
									  <li><a href="#">2</a></li>
									  <li><a href="#">3</a></li>
									  <li><a href="#">4</a></li>
									  <li><a href="#">5</a></li>
									  <li><a href="#">»</a></li>
								  </ul>
								  <ul class="pagination visible-xs pull-right">
									  <li><a href="#">«</a></li>
									  <li><a href="#">»</a></li>
								  </ul>
							  </div>
						  </div>
					  </div>
				  </div>
			  </div>
</template>
<style>
.page_name {
    margin-left: 11px;
}
.panell{
    font-family: 'Raleway', sans-serif;
    padding: 0;
    border: none;
    box-shadow: 0 0 10px rgba(0,0,0,0.08);
}
.panell .panell-heading{
    background: #535353;
    padding: 15px;
    border-radius: 0;
}
.panell .panell-heading .btn{
    color: #fff;
    background-color: #000;
    font-size: 14px;
    font-weight: 600;
    padding: 7px 15px;
    border: none;
    border-radius: 0;
    transition: all 0.3s ease 0s;
}
.panell .panell-heading .btn:hover{ box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); }
.panell .panell-heading .form-horizontal .form-group{ margin: 0; }
.panell .panell-heading .form-horizontal label{
    color: #fff;
    margin-right: 10px;
}
.panell .panell-heading .form-horizontal .form-control{
    display: inline-block;
    width: 80px;
    border: none;
    border-radius: 0;
}
.panell .panell-heading .form-horizontal .form-control:focus{
    box-shadow: none;
    border: none;
}
.panell .panell-body{
    padding: 0;
    border-radius: 0;
}
.panell .panell-body .table thead tr th{
    color: #fff;
    background: #8D8D8D;
    font-size: 17px;
    font-weight: 700;
    padding: 12px;
    border-bottom: none;
}
.panell .panell-body .table thead tr th:nth-of-type(1){ width: 120px; }
.panell .panell-body .table thead tr th:nth-of-type(5){ width: 20%; }
.panell .panell-body .table tbody tr td{
    color: #555;
    background: #fff;
    font-size: 15px;
    font-weight: 500;
    padding: 13px;
    vertical-align: middle;
    border-color: #e7e7e7;
}
.panell .panell-body .table tbody tr:nth-child(odd) td{ background: #f5f5f5; }
.panell .panell-body .table tbody .action-list{
    padding: 0;
    margin: 0;
    list-style: none;
}
.panell .panell-body .table tbody .action-list li{ display: inline-block; }
.panell .panell-body .table tbody .action-list li a{
    color: #fff;
    font-size: 13px;
    line-height: 28px;
    height: 28px;
    width: 33px;
    padding: 5px;
    border-radius: 0;
    transition: all 0.3s ease 0s;
}
.panell .panell-body .table tbody .action-list li a:hover{ box-shadow: 0 0 5px #ddd; }
.panell .panell-footer{
    color: #fff;
    background: #535353;
    font-size: 16px;
    line-height: 33px;
    padding: 25px 15px;
    border-radius: 0;
}
.pagination{ margin: 0; }
.pagination li a{
    color: #fff;
    background-color: rgba(0,0,0,0.3);
    font-size: 15px;
    font-weight: 700;
    margin: 0 2px;
    border: none;
    border-radius: 0;
    transition: all 0.3s ease 0s;
}
.pagination li a:hover,
.pagination li a:focus,
.pagination li.active a{
    color: #fff;
    background-color: #000;
    box-shadow: 0 0 5px rgba(0,0,0,0.4);
}
</style>
<script>
import axios from 'axios';

    export default {
        
		data() {
			return {
				orders : []
			}
		},
		mounted() {
			this.getOrders();
        },
		methods: {
			 getOrders() {
			// 	axios.get('http://127.0.0.1:8000/api/orders_list').then(res =>{
			// 		console.log(res)
			// 	});
			 axios.get('/api/orders_list/').then(response => {
                
                console.log(response.data);
				this.orders = response.data.ordersList
				
            }).catch(error =>{
                console.log(error)
                this.categories = []
            })
			}
		}
    }
</script>
