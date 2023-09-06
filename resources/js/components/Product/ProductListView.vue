<template>
	<div class="col-md-8">
		<h1>Products List</h1>
		<div class="panell">
			<div class="panell-body table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Image</th>
							<th>Price</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(product, index) in products" :key="index">
							<td> {{ product.id }} </td>
							<td> {{ product.name }} </td>
							<td><img class="product-image" :src="'/upimages/' + product.image"></td>
							<td> {{ product.price }} </td>
							<td>
								<ul class="action-list">
									<li>
										<RouterLink :to="{ path: '/admin/view-product/' + product.id + '' }"
											class="btn btn-primary"> <i class="fa fa-search"></i></RouterLink>
									</li>
									<li><a href="" @click.prevent="deleteItem(product.id)" class="btn btn-danger"><i
												class="fa fa-times"></i></a></li>
									<li><a href="#" class="btn btn-sm btn-success"><i class="fa fa-search"></i></a></li>
								</ul>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</template>
<style>
.page_name {
	margin-left: 11px;
}
</style>
<script>
import axios from 'axios';
import Swal from 'sweetalert2/dist/sweetalert2';

export default {

	data() {
		return {
			products: []
		}
	},
	mounted() {
		this.getProducts();
	},
	methods: {
		getProducts() {
			axios.get('/api/products-list/').then(response => {
				this.products = response.data.productsList
			}).catch(error => {
				console.log(error)
			})
		},
		
		deleteItem(productId) {
		if(confirm('Do you really want to delete ?')) {
			axios.delete(`/api/delete-product/${productId}/` ).then(response => {
				if(response.data.status == 200) {
				Swal.fire({
                        // position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

					this.getProducts();
				}
			});
		}
		}
	}
}
</script>
