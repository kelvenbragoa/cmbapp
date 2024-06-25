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
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

let retrievedData =ref([]);
let loadingSubmit =ref([true]);
let loadingDiv =ref([true]);
const router = useRouter();
let self = this;
const chartData = reactive({
          labels: [  '1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'
                ],
                datasets: [
                          {
                            label: 'Pagamento de Taxas',
                            backgroundColor: '#50B3C7',
                            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0]
                          },
                        ]
        })
        const  chartOptions = {
          responsive: true, 
        }







const getData = () => {
  axios.get(`/users/+${router.currentRoute.value.params.id}`)
       .then((response)=>{
        loadingDiv.value=false;
        retrievedData.value = response.data.user;
        chartData.datasets[0].data = response.data.dataChartPaymentDay;
           }).catch(()=>{
        loadingDiv.value=false;
       })
}




onMounted(()=>{
  
  getData();
})
</script>

<template>
    <div v-if="!loadingDiv">

        <h1 class="h3 mb-3">Usuário</h1>
        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Usuário</h5>

                                        <router-link to="/manager/users" class="btn btn-pill btn-primary mt-3"><vue-feather type="arrow-left"></vue-feather>Voltar</router-link> 
								    </div>
                                    
                                    <div class="card-body">
                                          
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12 d-flex">
                                                <div class="w-100">
                                                    <p>Nome: {{ retrievedData.firstName }} {{ retrievedData.lastName }}</p>
                                                    <p>Email: {{ retrievedData.email }}</p>
                                                    <p>Código: {{ retrievedData.code }}</p>
                                                    <p>Telefone: {{ retrievedData.mobile }}</p>
                                                    <p>Estado do usuário: {{ retrievedData.user_status.name }}</p>
                                                    <p>Nível: {{ retrievedData.role.name }}</p>    
                                                    <p>Permissões</p>
                                                    <ul>
                                                        <li v-for="permission in retrievedData.permissions" :key="permission.id">
                                                            {{ permission.fee.name }}
                                                        </li>
                                                    </ul>   
                                                    <hr>
                                                    <div class="col-12 col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-title">Cobrança das taxas por dia durante corrente mês do ano</h5>
                                                                <h6 class="card-subtitle text-muted">Cobrança das taxas por dia durante corrente mês do ano</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="chart">
                                                                    <Bar
                                                                        id="my-chart-id"
                                                                        :options="chartOptions"
                                                                        :data="chartData"
                                                                        :key="componentKey"
                                                                        />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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