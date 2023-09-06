<template>
    <div class="col-md-10">
        <div class="card-body order-main p-0">
            <hr class="my-5">
            <div class="row pb-5 p-5">
                <div class="col-md-6">
                    <p class="font-weight-bold  text-uppercase mb-4 details-block">Client Information</p>
                    
                    <p v-for="(userDetail, index) in userDetails" :key="index">
                    <p class="mb-1"><span class="text-muted">Name: </span>{{userDetail.name +' '+ userDetail.last_name}}</p>
                    <p class="mb-1"><span class="text-muted">Email: </span>{{userDetail.email}}</p>    
                    <p class="mb-1"><span class="text-muted">Phone: </span>{{userDetail.phone}}</p> 
                    <p class="mb-1"><span class="text-muted">Address: </span>{{userDetail.address}}</p> 
                    <p class="mb-1"><span class="text-muted">Pin number: </span>{{userDetail.pin_number}}</p> 
                    </p>
                </div>

                <div class="col-md-6 text-right">
                    <p class="font-weight-bold details-block text-uppercase mb-4">Payment Details</p>
                    <p class="mb-1"><span class="text-muted">VAT: </span> 1425782</p>
                    <p class="mb-1"><span class="text-muted">VAT ID: </span> 10253642</p>
                    <p class="mb-1"><span class="text-muted">Payment Type: </span> Root</p>
                    <p class="mb-1"><span class="text-muted">Name: </span> John Doe</p>
                </div>
            </div>

            <div class="row p-5">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                                <th class="border-0 text-uppercase small font-weight-bold">Order Id</th>
                                <th class="border-0 text-uppercase small font-weight-bold">Item</th>
                                <th class="border-0 text-uppercase small font-weight-bold">Image</th>
                                <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                                <th class="border-0 text-uppercase small font-weight-bold">Price</th>
                                <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(orderItem, index) in orderItems" :key="index">
                                <td>1</td>
                                <td>{{ orderItem.order_id }}</td>
                                <td>{{ orderItem.name }}</td>
                                <td><img class="product-image" :src="'/images/'+ orderItem.image" ></td>
                                <td>{{ orderItem.quantity }}</td>
                                <td>{{ orderItem.price }}</td>
                                <td>{{ orderItem.price * orderItem.quantity }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-10">
                <ul id="progressbar" class="text-center">
                    <li class="active" id="step1">
                        <div class="d-none d-md-block">STEP 1</div>
                    </li>
                    <li class="active" id="step2">
                        <div class="d-none d-md-block">STEP 2</div>
                    </li>
                    <li class="" id="step3">
                        <div class="d-none d-md-block">STEP 3</div>
                    </li>
                    <li class="" id="step4">
                        <div class="d-none d-md-block">STEP 4</div>
                    </li>
                    <li class="" id="step5">
                        <div class="d-none d-md-block">STEP 5</div>
                    </li>
                    <li class="" id="step6">
                        <div class="d-none d-md-block">STEP 5</div>
                    </li>
                </ul>
            </div>
            <div class=" ">
                <div class="">Grand Total</div>
                <div class="h2 font-weight-light">$234,234</div>
            </div>
        </div>
        </div>
</template>
<style>
.order-main {
    margin-left: 30px;
    margin-right: 5px;

}
.product-image {
    width: 45px;
    height: 65px;
}

.details-block {
    font-weight: 600;
}

.text-right {
    padding-right: 100px
}

#progressbar {
    margin-bottom: 20px;
    overflow: hidden;
    color: #455A64;
    padding-left: 0px;
    margin-top: 30px
}

#progressbar li {
    list-style-type: none;
    width: 14.66%;
    float: left;
    position: relative;
    font-weight: 400
}

#progressbar #step1:before {
    content: "1";
}

#progressbar #step2:before {
    content: "2";
}

#progressbar #step3:before {
    content: "3";
}

#progressbar #step4:before {
    content: "4";
}

#progressbar #step5:before {
    content: "5";
}

#progressbar #step6:before {
    content: "6";
}

#progressbar li:before {
    width: 40px;
    height: 40px;
    line-height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    background: #455A64;
    border-radius: 50%;
    margin: auto;
    color: #fff;
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: #455A64;
    position: absolute;
    left: 0;
    top: 21px;
    /* z-index: -1 */
    z-index: -0
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    position: absolute;
    left: -50%
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    position: absolute;
    left: 50%
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: #099d08
}
</style>
<script>
import axios from 'axios';

export default {

    data() {
        return {
            orderItems: [],
            userDetails: [],
        }
    },
    mounted() {
        this.getOrderDetails(this.$route.params.id);
        this.getOrderUserDetails(this.$route.params.id);
    },
    methods: {
        getOrderDetails(orderId) {
            axios.get(`/api/orders_view/${orderId}/`).then(response => {
                this.orderItems = response.data.ordersItems
            }).catch(error => {
                console.log(error)
                this.categories = []
            })
        },
        getOrderUserDetails(orderId) {
            axios.get(`/api/order_user_data/${orderId}/`).then(response => {
                this.userDetails = response.data.userDetails
                console.log(response.data.userDetails);
            }).catch(error => {
                console.log(error)
                this.categories = []
            })
        },
    }
}
</script>
