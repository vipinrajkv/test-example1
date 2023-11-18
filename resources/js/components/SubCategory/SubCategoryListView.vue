<template>
	<div class="col-md-8">
		<h1>Sub Category List</h1>
		<div class="panell">
			<div class="panell-body table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Sub Category Name</th>
							<th>Category Name</th>
							<th>Satus</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(subcategory, index) in subcategories" :key="index">
							<td> {{ subcategory.id }} </td>
							<td> {{ subcategory.sub_category_name }} </td>
							<td> {{ subcategory.category.category_name }} </td>
							<td> {{ subcategory.status }} </td>
							<td>
								<ul class="action-list">
									<li>
										<RouterLink :to="{ path: '/admin/view-subcategory/' + subcategory.id + '' }"
											class="btn btn-primary"> <i class="fa fa-search"></i></RouterLink>
									</li>
									<li><a href="" @click.prevent="deleteItem(subcategory.id)" class="btn btn-danger"><i
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
			subcategories: []
		}
	},
	mounted() {
		this.getCategories();
	},
	methods: {
		getCategories() {
			axios.get('/api/get-subcategory-list/').then(response => {
				console.log(response.data.categoryList);
				this.subcategories = response.data.subCategoryList
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
