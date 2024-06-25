<script setup>

import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent,watch } from "vue";
import moment from 'moment'
import {useToastr} from '../../../toastr';
import {debounce} from 'lodash';
import {Form, Field, FieldArray} from 'vee-validate';
import { useRouter} from "vue-router";
import * as yup from 'yup';
import VueFeather from 'vue-feather';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';

let retrievedData =ref([]);
let roles =ref([]);
let areas =ref([]);
let provinces =ref([]);
let cities =ref([]);
let user_statuses =ref([]);
let account_statuses =ref([]);
const province_id_to_city = ref(0);
let loadingButtonSubmit =ref([false]);
let loadingDiv =ref([true]);
const toastr = useToastr();
const router = useRouter();
let self = this;
const permissionsdata = ref([]);

let currentvalue = ref([]);




const schema = yup.object({
    first_name: yup.string().required(),
    last_name: yup.string().required(),
    email: yup.string().email().required(),
    code: yup.string().required(),
    mobile: yup.string().required(),
    role_id: yup.string().required(),
    user_status_id: yup.string().required(),
    
  });







const getData = () => {
  axios.get(`/users/+${router.currentRoute.value.params.id}/edit`)
       .then((response)=>{

       
        retrievedData.value = response.data.user;
        roles.value = response.data.roles;
        user_statuses.value = response.data.user_statuses;
        permissionsdata.value = response.data.permissions;


        loadingDiv.value=false;

       }).catch(()=>{

        loadingDiv.value=false;

       })
}

const editFunction = (values, actions) => {

  loadingButtonSubmit.value = true;
  axios.patch(`/users/${retrievedData.value.id}`,values).then((response)=>{

    // admins.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    actions.resetForm();
    router.push({ path: '/admin/users' });
    toastr.success('Usuário editada com sucesso');

  }).catch((error)=>{
    loadingButtonSubmit.value = false;
    toastr.error('Erro ao editar');
    if(error.response.data.errors){
      actions.setErrors(error.response.data.errors);
    }

  }).finally(()=>{
    loadingButtonSubmit.value = false;
  })
};





onMounted(()=>{
  
  getData();

})
</script>

<template>
    <div v-if="!loadingDiv">

        <h1 class="h3 mb-3">Usuário </h1>
        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Usuário: {{ retrievedData.name }}</h5>

                                        <router-link to="/admin/users" class="btn btn-pill btn-primary mt-3"><vue-feather type="arrow-left"></vue-feather>Voltar</router-link> 

                                       
								    </div>
                                    
                                    <div class="card-body">
                                          
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12 d-flex">
                                                <div class="w-100">
                                                    <Form @submit="editFunction" :validation-schema="schema" v-slot="{ errors }">

                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="first_name">Primeiro Nome</label>
                                                                <Field type="text" class="form-control" :class="{'is-invalid':errors.first_name}" v-model="retrievedData.first_name" name="first_name" id="first_name" placeholder="Primeiro Nome"/>
                                                                <span class="invalid-feedback">{{ errors.first_name }}</span>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label" for="last_name">Apelido</label>
                                                                <Field type="text" class="form-control" :class="{'is-invalid':errors.last_name}"  v-model="retrievedData.last_name" name="last_name" id="last_name" placeholder="Apelido"/>
                                                                <span class="invalid-feedback">{{ errors.last_name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="email">Email</label>
                                                            <Field type="email" class="form-control"  :class="{'is-invalid':errors.email}" v-model="retrievedData.email" name="email" id="email" placeholder="Email"/>
                                                            <span class="invalid-feedback">{{ errors.email }}</span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="password">Palavra passe</label>
                                                            <Field type="password" class="form-control"  :class="{'is-invalid':errors.password}" name="password" id="password" placeholder="Palavra passe"/>
                                                            <span class="invalid-feedback">{{ errors.password }}</span>
                                                        </div>
                                                      
                                                        <div class="mb-3">
                                                            <label class="form-label" for="code">Código</label>
                                                            <Field type="text" class="form-control" :class="{'is-invalid':errors.code}" v-model="retrievedData.code" name="code" id="code" placeholder="Código do Usuário"/>
                                                            <span class="invalid-feedback">{{ errors.code }}</span>
                                                        </div>
                                                        
                                                        <div class="mb-3">
                                                            <label class="form-label" for="mobile">Telefone</label>
                                                            <Field type="text" class="form-control" :class="{'is-invalid':errors.mobile}" v-model="retrievedData.mobile" name="mobile" id="mobile" placeholder="Telefone"/>
                                                            <span class="invalid-feedback">{{ errors.mobile }}</span>
                                                        </div>
                                                       
                                                        <div class="row">
                                                            
                                                           
                                                            <div class="mb-3 col-md-4">
                                                                <label class="form-label" for="role_id">Nível</label>
                                                                <Field as="select" class="form-control" :class="{'is-invalid':errors.role_id}" v-model="retrievedData.role_id"  name="role_id" id="role_id" aria-describedby="role_id">
                                                                    <option value="" disabled>Selecionar</option>
                                                                    <option v-for="role in roles" :key="role.id" :value="role.id" disabled>{{ role.name }}</option>
                                                                </Field>
                                                                <span class="invalid-feedback">{{ errors.role_id }}</span>
                                                            </div>

                                                            <div class="mb-3 col-md-4">
                                                                <label class="form-label" for="user_status_id">Estado do usuário</label>
                                                                <Field as="select" class="form-control" :class="{'is-invalid':errors.user_status_id}"  v-model="retrievedData.user_status_id"  name="user_status_id" id="user_status_id" aria-describedby="user_status_id">
                                                                    <option value="" disabled>Selecionar</option>
                                                                    <option v-for="user_status in user_statuses" :key="user_status.id" :value="user_status.id">{{ user_status.name }}</option>
                                                                </Field>
                                                                <span class="invalid-feedback">{{ errors.user_status_id }}</span>
                                                            </div>

                                                           
                                                        </div>
                                                        <div class="row">
                                                            <label class="form-label" for="role_id">Permissões atuais</label>
                                                             <div class="m-2"  v-for="(permission,idx) in retrievedData.permissions" :key="permission.id">
                                                                <p>{{ idx+1 }} - <strong>{{ permission.fee.name }}</strong></p>
                                                             </div>

                                                        </div>
                                                        <div class="row">
                                                        
                                                    <label class="form-label" for="role_id">Reescrever Permissões</label>
                                               
                                                    <FieldArray class="form-control" name="planequipments">
                                                                                <div class="mb-2" v-for="(permission,idx) in permissionsdata" :key="permission.id">
                                                                                    <Field class="form-check-input" type="checkbox" :value="permission.id"  :id="`userpermissions[${idx}].permission_id`" :name="`userpermissions[${idx}].permission_id`" :unchecked-value="true"/>
                                                                                    <span class="form-check-label">
                                                                                    {{ permission.name }} - {{ permission.amount }} MT
                                                                                    </span> 
                                                                                </div>
                                                                            </FieldArray>
                                                </div>
                                                       

                                                      

                                                      
                                                        <button type="submit" class="btn btn-primary" :disabled="loadingButtonSubmit == true">
                                                            <div v-if="loadingButtonSubmit == true" class="spinner-border spinner-border-sm" role="status"></div>
                                                            <span v-else>Submeter</span>
                                                        </button>


                                                    </Form>
                                                    
                                            
                                                
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