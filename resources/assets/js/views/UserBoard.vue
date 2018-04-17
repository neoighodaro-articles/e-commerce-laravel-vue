<template>
    <div>
        <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
            <h2 class="title">All your orders</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <div class="row">
                        <div class="col-md-4 product-box" v-for="(order,index) in orders" @key="index">
                            <img :src="order.product.image" :alt="order.product.name">
                            <h5><span v-html="order.product.name"></span><br>
                                <span class="small-text text-muted">$ {{order.product.price}}</span>
                            </h5>
                            <hr>
                            <span class="small-text text-muted">Quantity: {{order.quantity}}
                                <span class="float-right">{{order.is_delivered == 1? "shipped!" : "not shipped"}}</span>
                            </span>
                            <br><br>
                            <p><strong>Delivery address:</strong> <br>{{order.address}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                user : null,
                orders : []
            }
        },
        beforeMount(){
            this.user = JSON.parse(localStorage.getItem('user'))
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')

            axios.get(`api/users/${this.user.id}/orders`)
            .then(response => {
                this.orders = response.data
            })
            .catch(error => {
                console.error(error);
            })       
        }
    }
</script>
<style scoped>
    .small-text {
        font-size: 14px;
    }
    .product-box {
        border: 1px solid #cccccc;
        padding: 10px 15px;
    }
    .hero-section {
        height: 20vh;
        background: #ababab;
        align-items: center;
        margin-bottom: 20px;
        margin-top: -20px;
    }
    .title {
        font-size: 60px;
        color: #ffffff;
    }
</style>