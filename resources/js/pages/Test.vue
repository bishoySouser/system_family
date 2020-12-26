<template>  
       <div class='container mt-3'>
           <!-- Service -->
            <div class="card">
                <h5 class="card-header">Service</h5>
                <div class="card-body">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" v-model="service.name" placeholder="Name" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" v-model="service.desc" placeholder="Description" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <!-- category -->
                    <div class="card bg-success" v-if="categories.length > 0">
                        <div class="card-header">
                            Category
                        </div>
                        <div class="card-body">
                            <div v-for="(category, index) in categories" :key="index" class="mb-3">
                                <input type="text" class="form-control" v-model="category.name" :placeholder="'category:' + index" :key="index">
                                <button class="bg-danger" @click.prevent="deleteCategory(index)"> del Category</button>

                                    <!-- items -->
                                    <div class="card" v-if="category.items.length > 0">
                                        <div class="card-header">
                                            Items
                                        </div>
                                        <div class="card-body">
                                            <div v-for="(item, indexItem) in category.items" :key="indexItem" class="mb-3">
                                                <input type="text" v-model="item.name" placeholder="item name" :key="indexItem">
                                                <button class="bg-danger" @click.prevent="deleteItem(index, indexItem)"> del Category</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                            <button class="btn btn-primary" @click.prevent="addItem(index)">Add Item</button>
                                
                                
                            </div>
                        </div>
                    </div>

                    <button href="#" class="btn btn-primary"
                        @click.prevent="addCategory()"
                        :disabled="requiredService()">Add Category</button>
                </div>
            </div>

            <button href="#" class="btn btn-primary" @click.prevent="save()">Save</button>
       </div>
</template>

<script>
// import { delete } from 'vue/types/umd';

export default {
    name:'test',
    components: {
        
    },
    data() {
        return {
            service: {
                name: '',
                desc: '',
                categories: [],
            },
            categories: [],
            items: []
            
        }
    },
    methods: {
        requiredService(){
            if (this.service.name && this.service.desc) {
                if (this.categories.length > 0) {
                    return this.requireCategory();
                }
                return false
            }
            else
            {
                return true
            }
        },
        requireCategory(){
            return this.categories.some(category => !category.name);
        },
        addCategory() {
            console.log("add Category.")
            this.categories.push({name: '', items: []})
        },
        deleteCategory(index) {
            this.categories.splice(index, 1);
        },
        addItem(index) {
            console.log(this.categories[index])
            this.categories[index].items.push({name: ''})
        },
        deleteItem(index, indexItem) {
          
            this.categories[index].items.splice(indexItem, 1);
        }
    },
    watch: {
        categories : function (val){
            this.service.categories = val
        }
    },
    created(){
        
    }
}
</script>

<style>
    .card{
        margin-left: 10px;
        }
</style>