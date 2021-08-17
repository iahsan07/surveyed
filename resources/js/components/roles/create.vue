<template>
    <form role="form" @submit.prevent="saveRole">
        <loader v-if="loading"></loader>
        <div class="box-body">
            <div class="form-group" :class="{ 'has-error': errors.name }">
                <label for="exampleInputEmail1">Name <span class="required-star">*</span></label>
                <input type="text" class="form-control" v-model="role.name" id="exampleInputEmail1" placeholder="Enter role name">
                <span v-if="errors.name" class="help-block">{{errors.name}}</span>
            </div>
            <div class="form-group" :class="{ 'has-error': errors.slug }">
                <label for="exampleInputPassword1">Slug <span class="required-star">*</span></label>
                <input type="text" class="form-control" v-model="role.slug" id="exampleInputPassword1" :disabled="role.slug=='super_admin'" placeholder="Enter role unique slug to identify role">
                <span v-if="errors.slug" class="help-block">{{errors.slug}}</span>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Permissions</label>
                <div class="checkbox" v-for="permission in permissions">
                    <label>
                        <input type="checkbox" :disabled="role.slug=='super_admin'" :value="permission.id" v-model="role.checkedPerms">
                        {{permission.name}}
                    </label>
                </div>
            </div>
        </div>
        <!-- /.box-body -->



        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</template>

<script>
    import {HttpService} from "../../services/HttpService";
    export default {
        props:['roleObj'],
        data(){
            return {
                service: new HttpService(),
                loading:false,
                permissions:[],
                role:{
                    id:null,
                    name:'',
                    slug:'',
                    checkedPerms:[],
                },
                errors:{},
            }

        },

        created() {
            this.getPermissions();
        },

        methods:{

            async getPermissions(){
                try {
                    this.loading = true;
                    const permPromise = await this.service.setBaseUrl().get(`roles/get-permissions`, {})
                    this.loading = false
                    if(permPromise.success){
                        this.permissions = permPromise.data;
                        if(this.roleObj){
                            this.setRole();
                        }
                    }
                } catch(error) {
                    this.loading = false
                }
            },

            async saveRole(){
                if(this.roleObj){
                    this.updateRole();
                } else {
                    this.createRole();
                }
            },

            async createRole(){
                this.errors = {};
                try {
                    this.loading = true;
                    const savePromise = await this.service.setBaseUrl().post(`roles`, {
                        role:this.role
                    })
                    this.loading = false
                    window.location = "/portal/roles";

                } catch(error) {
                    console.log(error)
                    this.loading = false
                    if(!error.response.data.success){
                        this.errors = error.response.data.errors;
                    }
                }
            },

            async updateRole(){
                this.errors = {};
                try {
                    this.loading = true;
                    const savePromise = await this.service.setBaseUrl().put(`roles/${this.role.id} `, {
                        role:this.role
                    })
                    this.loading = false
                    Swal.fire('Success', 'Role Updated', "success");

                } catch(error) {
                    this.loading = false
                    if(!error.response.data.success){
                        this.errors = error.response.data.errors;
                        if(error.response.data.s_error){
                            Swal.fire('Error', 'Something went wrong', "error");
                        }
                    }
                }
            },

            setRole(){
                this.role.name = this.roleObj.name;
                this.role.slug = this.roleObj.slug;
                this.role.id = this.roleObj.id;
                this.role.checkedPerms = this.roleObj.permissions;
                if(this.role.slug=='super_admin'){
                    let output = [];
                    for (var i=0; i < this.permissions.length ; ++i){
                        output.push(this.permissions[i].id);
                    }
                    this.role.checkedPerms = output;
                }
            }

        }
    }
</script>
