<template>
	<div class="col-md-8">
		<h1>Category List</h1>
		<div class="panell">
			<div class="panell-body table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Price</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(category, index) in categories" :key="index">
							<td> {{ category.id }} </td>
							<td> {{ category.category_name }} </td>
							<td> {{ category.status }} </td>
							<td>
								<ul class="action-list">
									<li>
										<RouterLink :to="{ path: '/admin/view-category/' + category.id + '' }"
											class="btn btn-primary"> <i class="fa fa-search"></i></RouterLink>
									</li>
									<li><a href="" @click.prevent="deleteItem(category.id)" class="btn btn-danger"><i
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
			categories: []
		}
	},
	mounted() {
		this.getCategories();
	},
	methods: {
		getCategories() {
			axios.get('/api/get-category-list/').then(response => {
				console.log(response.data.categoryList);
				this.categories = response.data.categoryList
			}).catch(error => {
				console.log(error)
			})
		},
		
		// deleteItem(productId) {
		// if(confirm('Do you really want to delete ?')) {
		// 	axios.delete(`/api/delete-product/${productId}/` ).then(response => {
		// 		if(response.data.status == 200) {
		// 		Swal.fire({
        //                 // position: 'top-end',
        //                 icon: 'success',
        //                 title: response.data.message,
        //                 showConfirmButton: false,
        //                 timer: 1500
        //             });

		// 			this.getProducts();
		// 		}
		// 	});
		// }
		// }
	}
}
</script>
