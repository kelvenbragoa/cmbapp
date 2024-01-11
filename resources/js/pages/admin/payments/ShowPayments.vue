<script setup>

import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent,watch } from "vue";
import moment from 'moment'
import {useToastr} from '../../../toastr';
import {debounce} from 'lodash';
import {Form, Field} from 'vee-validate';
import { useRouter} from "vue-router";
import * as yup from 'yup';
import VueFeather from 'vue-feather';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';

let retrievedData =ref([]);
const searchQuery = ref(null);
let equipments =ref([]);
let loadingSubmit =ref([true]);
let loadingDiv =ref([true]);
const router = useRouter();
let self = this;







const getData = async (page = 1) => {
  axios.get(`/payments/+${router.currentRoute.value.params.id}?page=${page}`, 
  {
        params:{
          query: searchQuery.value
        }
      })
       .then((response)=>{
        loadingDiv.value=false;
        retrievedData.value = response.data.payment;
        
     
       }).catch(()=>{
        loadingDiv.value=false;
       })
}

watch(searchQuery,debounce(()=>{
    getData();
},300));


onMounted(()=>{
  getData();
})
</script>

<template>
    <div v-if="!loadingDiv">

        <h1 class="h3 mb-3">Taxas e Licença</h1>
        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Taxas e Licença: {{ retrievedData.name }}</h5>

                                        <router-link to="/admin/payments" class="btn btn-pill btn-primary mt-3"><vue-feather type="arrow-left"></vue-feather>Voltar</router-link> 

                                       
								    </div>
                                    
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12 d-flex">
                                                <div class="w-100">
                                                    <p>Nome da Taxas e Licença: {{ retrievedData.fee.name }}</p>
                                                    <p>Valor: {{ retrievedData.amount }} MT</p>
                                                    <p>Operador: {{ retrievedData.user.first_name}} {{ retrievedData.user.last_name}}</p>
                                                    <p>Data: {{moment(retrievedData.created_at).format('DD-MM-YYYY H:mm')}}</p>      
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
                            </div>   
                        </div>
                    </div>
    <div v-else>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    Carregando Dados...
                </div>
            </div> 
        </div>
    </div>
</template>