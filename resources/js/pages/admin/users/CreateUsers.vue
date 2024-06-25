<script setup>

import {onMounted, ref, reactive,watch} from 'vue';
import axios from 'axios';
import {useToastr} from '../../../toastr';
import {Form, Field, FieldArray} from 'vee-validate';
import * as yup from 'yup';
import { useRouter } from "vue-router";
import moment from 'moment'
import {debounce} from 'lodash';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
import VueFeather from 'vue-feather';

const loading = ref(false);
const toastr = useToastr();
let roles =ref([]);
let areas =ref([]);
let destinations =ref([]);
let currentvalue = ref([]);
let provinces =ref([]);
let cities =ref([]);
let user_statuses =ref([]);
let account_statuses =ref([]);
const loadingDiv = ref(true);
const province_id_to_city = ref(0);
const user_role = ref(0);
const permissionsdata = ref([]);

const schema = yup.object({
    
  first_name: yup.string().required(),
  last_name: yup.string().required(),
  email: yup.string().email().required(),
  password: yup.string().required().min(8),
  code: yup.string().required(),
  mobile: yup.string().required(),
  role_id: yup.string().required(),
  user_status_id: yup.string().required(),
  
});
let self = this;
const router = useRouter();

const createRecordFunction = (values, actions) => {


    currentvalue.value = {values};

    loading.value = true;

    const arr = Array.from(values)

    console.log(arr)
    console.log(values)
    
    axios.post('/users',values).then((response)=>{

    // categories.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    actions.resetForm();
    router.push({ path: '/admin/users' });
    toastr.success('Usuário criado com sucesso');
  }).catch((error)=>{
    
    loading.value = false;
    toastr.error('Erro ao adicionar. '+error.response.data.message);
    if(error.response.data.errors){
       
        actions.setErrors(error.response.data.errors);
    }
  }).finally(()=>{
    loading.value = false;
   
    
  })



};



const getAuxiliarData = () => {

  axios.get('/auxiliar-create-data')
       .then((response)=>{

        roles.value = response.data.roles;
        areas.value = response.data.areas;
        destinations.value = response.data.destinations;
        provinces.value = response.data.provinces;
        user_statuses.value = response.data.user_statuses;
        account_statuses.value = response.data.account_statuses;
        permissionsdata.value = response.data.permissions;
        loadingDiv.value=false;

       


       })
       .catch((error)=>{
        toastr.error(error);
        router.push({ path: '/admin/users' });
       })
}


onMounted(()=>{
    getAuxiliarData()
})
</script>

<template>
    <div v-if="!loadingDiv">
        <h1 class="h3 mb-3">Usuários</h1>
        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Formulário criação dos usuários do sistema.</h5>

                                        <router-link to="/admin/users" class="btn btn-pill btn-primary mt-3"><vue-feather type="arrow-left"></vue-feather>Voltar</router-link> 

                                       
								    </div>
                                    
                                    <div class="card-body">
                                            <Form @submit="createRecordFunction" :validation-schema="schema" v-slot="{ errors }">
												<div class="row">
													<div class="mb-3 col-md-6">
														<label class="form-label" for="first_name">Primeiro Nome</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.first_name}" name="first_name" id="first_name" placeholder="Primeiro Nome"/>
                                                        <span class="invalid-feedback">{{ errors.first_name }}</span>
													</div>
													<div class="mb-3 col-md-6">
														<label class="form-label" for="last_name">Apelido</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.last_name}" name="last_name" id="last_name" placeholder="Apelido"/>
                                                        <span class="invalid-feedback">{{ errors.last_name }}</span>
													</div>
												</div>
												<div class="mb-3">
													<label class="form-label" for="email">Email</label>
													<Field type="email" class="form-control"  :class="{'is-invalid':errors.email}" name="email" id="email" placeholder="Email"/>
                                                    <span class="invalid-feedback">{{ errors.email }}</span>
												</div>
                                                <div class="mb-3">
													<label class="form-label" for="password">Palavra passe</label>
													<Field type="password" class="form-control"  :class="{'is-invalid':errors.password}" name="password" id="password" placeholder="Palavra passe"/>
                                                    <span class="invalid-feedback">{{ errors.password }}</span>
												</div>
												
												<div class="mb-3">
													<label class="form-label" for="code">Código</label>
													<Field type="text" class="form-control" :class="{'is-invalid':errors.code}" name="code" id="code" placeholder="Código do Usuário"/>
                                                    <span class="invalid-feedback">{{ errors.code }}</span>
												</div>
                                               
                                                <div class="mb-3">
													<label class="form-label" for="mobile">Telefone</label>
													<Field type="text" class="form-control" :class="{'is-invalid':errors.mobile}" name="mobile" id="mobile" placeholder="Telefone"/>
                                                    <span class="invalid-feedback">{{ errors.mobile }}</span>
												</div>
                                            
												<div class="row">
													
													
													<div class="mb-3 col-md-4">
														<label class="form-label" for="role_id">Nível</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.role_id}"  name="role_id" id="role_id" aria-describedby="role_id" v-model="user_role">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.role_id }}</span>
													</div>

                                                    <div class="mb-3 col-md-4">
														<label class="form-label" for="user_status_id">Estado do usuário</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.user_status_id}"  name="user_status_id" id="user_status_id" aria-describedby="user_status_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="user_status in user_statuses" :key="user_status.id" :value="user_status.id">{{ user_status.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.user_status_id }}</span>
													</div>

                                                    
												</div>

                                                <div class="row">
                                                    <label class="form-label" for="role_id">Permissões</label>
                                               
                                                    <FieldArray class="form-control" name="planequipments">
                                                                                <div class="mb-2" v-for="(permission,idx) in permissionsdata" :key="permission.id">
                                                                                    <Field class="form-check-input" type="checkbox" :value="permission.id" :id="`userpermissions[${idx}].permission_id`" :name="`userpermissions[${idx}].permission_id`"/>
                                                                                    <span class="form-check-label">
                                                                                    {{ permission.name }} - {{ permission.amount }} MT
                                                                                    </span> 
                                                                                </div>
                                                                            </FieldArray>
                                                </div>
                                             
												<button type="submit" class="btn btn-primary" :disabled="loading">
                                                    <div v-if="loading" class="spinner-border spinner-border-sm" role="status"></div>
                                                    <span v-else>Submeter</span>
                                                </button>
											</Form>

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