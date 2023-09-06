<template>
    <div class="col-md-8 content">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Product
            </div>
            <div class="panel-body">
                <!-- <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
                    <li class="" v-for="(error, index) in this.errorList" :key="index">
                       {{ error[0] }}
                    </li>
                </ul> -->
                <form ref="productForm">
                    <div class="form-group col-md-8">
                        <label for="usr">Name:</label>
                        <input type="text" name="name"  v-model="model.productData.name" class="form-control" id="usr">
                        <div v-if="errorList.name" :class="['invalid-feedback']"> {{ errorList.name[0] }}</div>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="usr">Price:</label>
                        <input type="text" name="price" v-model="model.productData.price" class="form-control" id="usr">
                        <div v-if="errorList.price" :class="['invalid-feedback']"> {{ errorList.price[0] }}</div>
                    </div>
                    <div class="form-group col-md-8">
                        <img class="product-image" :src="'/upimages/'+ model.productData.image" >
                    </div>
                    <div class="form-group col-md-8">
                        <label for="usr">Upload Image:</label>
                        <input type="file" id="file" @change="onImageChange" name="image">
                        <div v-if="errorList.image" :class="['invalid-feedback']"> {{ errorList.image[0] }}</div>
                    </div>
                    <div class="form-group col-md-8">
                        <button type="submit" @click.prevent="submit"> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<style>
.content {
    margin-top: 10px;
}
.invalid-feedback {
    color: red;
}
.product-image {
    width: 45px;
    height: 65px;
}
</style>
<script>
import Swal from 'sweetalert2/dist/sweetalert2';
export default {
    name: 'Edit Product',
    data() {
        return {
            file: '',
            errorList: '',
            productId:'',
            productItems: [],
            model: {
                productData: {
                    name: "",
                    image: "",
                    price: "",
                }
            },
        }
    },
    mounted() {
        this.productId = this.$route.params.id;
        this.getProductItem(this.productId);
    },
    methods: {

        getProductItem(productId) {
            axios.get(`/api/product-view/${productId}/`).then(response => {
                // console.log(response.data.productItems);
                this.model.productData = response.data.productItems
            }).catch(error => {
                console.log(error)
            })
        },

        onImageChange: function onImageChange(e) {
            this.file = e.target.files[0]
            // this.file = this.$refs.file.files[0];
        },
        
        submit() {
            let $this = this;
            let formData = new FormData(this.$refs.productForm);
            // this.file = this.$refs.file.files[0];

            formData.append("image", this.file);
            axios.post(`/api/update-product/${$this.productId}/`, formData, {
                header: {
                    "Content-Type": "multipart/form-data",
                },
            })
                .then(function (response) {
                    
                    console.log(response);
                    $this.model.productData = {
                        name: '',
                        image: '',
                        price: '',
                    }
                    Swal.fire({
                        // position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
                .catch(function (error) {

                    console.log($this.errorList);
                    // console.log(error.response.data.error);
                    if (error.response) {

                        if (error.response.status == 422) {
                            $this.errorList = error.response.data.error;
                        }
                    } else if (error.request) {

                    } else {

                    }

                })
        },
    },
}
</script>
