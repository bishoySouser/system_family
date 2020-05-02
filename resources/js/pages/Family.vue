<template>  
       <div class='container mt-3'>
        <!-- navbar -->
        <navFamily />
           <div class="card">
               <div class="card-header">
                   Familes
               </div>

               <div class="card-body">
                   <div class="col-12">
                       <!-- table -->
                       <div class="table-responsive" style='height: 50vh'>

                        <table class='table table-bordered text-center m-auto'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Father</th>
                                    <th>Mother</th>
                                    <th>Date of marriage</th>
                                    <th>children</th>
                                    <th>Info</th>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- if individual.length > 0 -->
                                <tr>
                                    
                                </tr>
                            </tbody>
                            <!-- else -->
                            <tbody>
                                <tr>
                                    <td class='text-center h5 text-danger' colspan='8'>click add Family</td>
                                </tr>
                            </tbody>
                            
                        </table>
                       </div>
                   </div>
               </div>
           </div>
       </div>
</template>

<script>
import navFamily from '../components/navbars/NavbarFamily';
export default {
    name:'family',
    components: {
        navFamily,
    }
}
</script>

<style>
    table{
        width: max-content !important;
    }

</style>