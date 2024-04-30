<script setup>

import {onMounted, ref, reactive, onUpdated} from 'vue';
import axios from 'axios';
import VueFeather from 'vue-feather';
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)
const loadingDiv = ref(true);
const users = ref(0)
const today = ref(0)
const yesterday = ref(0)
const month = ref(0)
const year = ref(0)
const malfunctions = ref(0)
const suppliers = ref(0)
const tasks = ref(0)
const equipments = ref(0)
const mcscr = ref(0)
const componentKey = ref(0);
const componentKey1 = ref(0);

let currency = new Intl.NumberFormat();
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

        const chartData1 = reactive({
            labels: [ 
                    'Janeiro',
                    'Fevereiro',
                    'Março',
                    'Abril',
                    'Maio',
                    'Junho',
                    'Julho',
                    'Agosto',
                    'Setembro',
                    'Outubro',
                    'Novembro',
                    'Dezembro' 
                ],
                datasets: [
                          {
                            label: 'Pagamento de Taxas por mês',
                            backgroundColor: '#50B3C7',
                            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                          },
                         
                        ]
        })
  const  chartOptions1 = {
          responsive: true, 
        }
const getDashboardData = () =>{
    axios.get('/admins/dashboard/getdashboarddata')
    .then((response)=>{
        users.value = response.data.users
        today.value = response.data.today
        yesterday.value = response.data.yesterday
        month.value = response.data.month
        year.value = response.data.year

        chartData.datasets[0].data = response.data.dataChartPaymentDay;
        chartData1.datasets[0].data = response.data.dataChartPaymentMonth;
        // malfunctions.value = response.data.malfunctions
        // suppliers.value = response.data.suppliers
        // tasks.value = response.data.tasks
        // equipments.value = response.data.equipments
        // mcscr.value = response.data.mcscr
        loadingDiv.value=false;
    })
}

const refreshData = () =>{
    getDashboardData()
    componentKey.value += 1;
    componentKey1.value += 1;
}   



onMounted(()=>{

    getDashboardData();
    setInterval(refreshData, 30000); 

})



onUpdated(()=>{

})



</script>


<template>

    <div v-if="!loadingDiv">
        <h1 class="h3 mb-3">Dashboard Admin</h1>
        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Dashboard</h5>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-sm-6 col-xl-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col mt-0">
                                                                <h5 class="card-title">Usuários</h5>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="stat text-primary">
                                                                    <vue-feather type="users"></vue-feather>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h1 class="mt-1 mb-3">{{users}}</h1>
                                                        <div class="mb-0">
                                                             <router-link to="/manager/users"><vue-feather type="eye"></vue-feather></router-link>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-xl-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col mt-0">
                                                                <h5 class="card-title">Taxas Hoje</h5>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="stat text-primary">
                                                                    <vue-feather type="dollar-sign"></vue-feather>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h1 class="mt-1 mb-3">{{ currency.format(today) }}</h1>
                                                        <div class="mb-0">
                                                             <router-link to="/manager/payments"><vue-feather type="eye"></vue-feather></router-link>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-xl-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col mt-0">
                                                                <h5 class="card-title">Taxas Ontem</h5>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="stat text-primary">
                                                                    <vue-feather type="dollar-sign"></vue-feather>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h1 class="mt-1 mb-3">{{ currency.format(yesterday) }}</h1>
                                                        <div class="mb-0">
                                                             <router-link to="/manager/payments"><vue-feather type="eye"></vue-feather></router-link>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-xl-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col mt-0">
                                                                <h5 class="card-title">Taxas Este Mês</h5>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="stat text-primary">
                                                                    <vue-feather type="dollar-sign"></vue-feather>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h1 class="mt-1 mb-3">{{ currency.format(month)  }}</h1>
                                                        <div class="mb-0">
                                                             <router-link to="/manager/payments"><vue-feather type="eye"></vue-feather></router-link>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-xl-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col mt-0">
                                                                <h5 class="card-title">Taxas Este Ano</h5>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="stat text-primary">
                                                                    <vue-feather type="dollar-sign"></vue-feather>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h1 class="mt-1 mb-3">{{ currency.format(year)  }}</h1>
                                                        <div class="mb-0">
                                                             <router-link to="/manager/payments"><vue-feather type="eye"></vue-feather></router-link>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        </div>
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
                                        <div class="col-12 col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title">Cobrança das taxas</h5>
                                                    <h6 class="card-subtitle text-muted">Cobrança das taxas por mês durante corrente ano.</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="chart">
                                                        <Bar
                                                            id="my-chart-id"
                                                            :options="chartOptions1"
                                                            :data="chartData1"
                                                            :key="componentKey1"
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