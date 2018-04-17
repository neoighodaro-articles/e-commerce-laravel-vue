<template>
	<div>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td></td>
                    <td>Product</td>
                    <td>Units</td>
                    <td>Price</td>
                    <td>Description</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product,index) in products" @key="index" @dblclick="editingItem = product">
                    <td>{{index+1}}</td>
                    <td v-html="product.name"></td>
                    <td v-model="product.units">{{product.units}}</td>
                    <td v-model="product.price">{{product.price}}</td>
                    <td v-model="product.price">{{product.description}}</td>
                </tr>
            </tbody>
        </table>
        <modal @close="endEditing" :product="editingItem" v-show="editingItem != null"></modal>
        <modal @close="addProduct"  :product="addingProduct" v-show="addingProduct != null"></modal>
        <br>
        <button class="btn btn-primary" @click="newProduct">Add New Product</button>
    </div>
</template>
<script>
    import Modal from './ProductModal'
	export default {
        data(){
            return {
                products : [],
                editingItem : null,
                addingProduct : null
            }
        },
        components : {
            Modal
        },
        beforeMount(){
            axios.get('/api/products/')
            .then(response => {
                this.products = response.data
            })
            .catch(error => {
                console.error(error);
            })     
        },
        methods : {
            newProduct(){
                this.addingProduct = {
                    name : null, 
                    units : null, 
                    price : null,
                    description : null,
                    image : null
                }
            },
            endEditing(product){
                this.editingItem = null
                let index = this.products.indexOf(product)
                axios.put(`/api/products/${product.id}`,{
                    name  : product.name,
                    units : product.units,
                    price : product.price,
                    description : product.description,
                })
                .then(response =>{
                    this.products[index] = product
                })
                .catch(response => {

                })
            },
            addProduct(product){
                this.addingProduct = null
                axios.post("/api/products/",{
                    name  : product.name,
                    units : product.units,
                    price : product.price,
                    description : product.description,
                    image : product.image
                })
                .then(response =>{
                    this.products.push(product)
                })
                .catch(response => {

                })
            }
        }
    }
</script>