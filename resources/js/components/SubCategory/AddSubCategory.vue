<template>
    <div class="col-md-8 content">
        <div class="panel panel-default">
            <div class="panel-heading">
                Add SubCategory
            </div>
            <div class="panel-body">
                <!-- <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
                    <li class="" v-for="(error, index) in this.errorList" :key="index">
                       {{ error[0] }}
                    </li>
                </ul> -->
                <form ref="subCategoryForm">
                    <div class="form-group col-md-8">
                        <label for="usr">Sub Category Name:</label>
                        <input type="text" name="sub_category_name" v-model="model.subCategoryData.sub_category_name" class="form-control" id="usr">
                        <div v-if="errorList.sub_category_name" :class="['invalid-feedback']"> {{ errorList.sub_category_name[0] }}</div>
                    
                    </div>
                    <div class="form-group col-md-8">
                            <label>Select Category:</label>
                            <select class='form-control'  v-model="model.subCategoryData.category_id" name="category_id" @change="onChange($event)">
                              <option value='0' >Select State</option>
                              <option v-for='data in categoryLists' :key="index" :value='data.id'>{{ data.category_name }}</option>
                            </select>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="usr">Status:</label>
                        <input type="checkbox" v-model="model.subCategoryData.status" true-value="1" false-value="0" id="accept" class="form-check-input">
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
    name: 'Add SubCategory',
    data() {
        return {
            errorList: '',
            categoryLists: [],
            model: {
                subCategoryData: {
                    sub_category_name: "",
                    category_id: "",
                    status: "",
                }
            },
        }
    },
    mounted() {
        console.log('Component mounted.');
        this.getCategory();
    },
    methods: {
        onChange(event) {
            this.category_id = event.target.value;
          },
        getCategory() {
            axios.get('/api/get-category-list/').then(response => {
                console.log(response.data.categoryList);
                this.categoryLists = response.data.categoryList
            }).catch(error => {
                console.log(error)
            })
        },
        submit() {
            let $this = this;
            let formData = new FormData($this.$refs.subCategoryForm);
            formData.append("category_id", this.category_id);
            axios.post("/api/update-subcategory", formData, {
                header: {
                    "Content-Type": "multipart/form-data",
                },
            })
                .then(function (response) {
                    $this.model.subCategoryData = {
                        sub_category_name: '',
                        category_id: '',
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
