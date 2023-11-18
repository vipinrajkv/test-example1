<template>
    <div class="col-md-8 content">
        <div class="panel panel-default">
            <div class="panel-heading">
                Add Category
            </div>
            <div class="panel-body">
                <!-- <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
                    <li class="" v-for="(error, index) in this.errorList" :key="index">
                       {{ error[0] }}
                    </li>
                </ul> -->
                <form ref="categoryForm">
                    <div class="form-group col-md-8">
                        <label for="usr">Category Name:</label>
                        <input type="text" name="category_name" v-model="model.categoryData.category_name" class="form-control" id="usr">
                        <div v-if="errorList.category_name" :class="['invalid-feedback']"> {{ errorList.category_name[0] }}</div>
                    
                    </div>
                    <div class="form-group col-md-8">
                        <label for="usr">Status:</label>
                        <input type="checkbox" v-model="model.categoryData.status" true-value="1" false-value="0" id="accept" class="form-check-input">
                        <div v-if="errorList.status" :class="['invalid-feedback']"> {{ errorList.status[0] }}</div>
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
</style>
<script>
import Swal from 'sweetalert2/dist/sweetalert2';
export default {
    name: 'Add Category',
    data() {
        return {
            errorList: '',
            model: {
                categoryData: {
                    category_name: "",
                    status: "",
                }
            },
        }
    },
    mounted() {
        console.log('Component mounted.')
    },
    methods: {
        submit() {
            let $this = this;
            let formData = new FormData(this.$refs.categoryForm);
 
            axios.post("/api/add-category", formData, {
                header: {
                    "Content-Type": "multipart/form-data",
                },
            })
                .then(function (response) {
                    $this.model.categoryData = {
                        category_name: '',
                        status: '',
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
