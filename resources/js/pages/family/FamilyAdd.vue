<template>  
       <div class='container mt-3'>
        <!-- navbar --> 
           <div class="card">
               <div class="card-header">
                   Family New
               </div>
               <div class="card-body">
                    <form>
                        <div class="form-row">
                            <!-- info family -->
                            <div class="form-group col-md-4">
                                <label for="inputFather">Father Name</label>
                                <input type="text" class="form-control" id="inputFather" placeholder="Enter Father name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputMother">Mather Name</label>
                                <input type="text" class="form-control" id="inputMother" placeholder="Enter Mother name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputDate">Date of marriage</label>
                                <input type="date" class="form-control" id="inputDate" placeholder="Enter Date of marriage">
                            </div>


                        </div>

                            <hr size="30">
                            <div class="form-row">
                                 
                            <button type="button" class="btn btn-primary">
                                Childern <span class="badge badge-light">{{childern.length}}</span>
                            </button>
                        
                            </div>
                        <div class="form-row">

                            <div class="form-group col-md-4 mt-2">
                                <input
                                    class="form-control"
                                    id="addChild" 
                                    placeholder="Add Childern" 
                                    v-model="child"
                                    v-on:keyup.enter='addChild'
                                    >
                            </div>
                        </div>
                    </form>
                    <div class="row">
                
                    </div>
                    <ul class='list-group' v-if="childern">
                        <li class='list-group-item' v-for='(child, index) in childern' :key='index'>
                            {{child}}<button class='btn btn-danger float-right' @click="removeChild(index)"><i class="fas fa-trash"></i></button>
                        </li>
                    </ul>

               </div>
               
           </div>
       </div>
</template>

<script>

export default {
    name:'add-family',
    components: {
        
    },
    data(){
        return{
            child: null,
            childern: [],
        }
    },
    methods:{
        addChild(){
            this.childern.push(this.child)
            this.child = null
        },
        removeChild(id){
            this.childern.splice(id,1)
        }
    }
}
</script>

<style>

</style>