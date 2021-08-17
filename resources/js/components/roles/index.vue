<template>
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
                <tr v-for="role in roles">
                    <td>{{role.name}}</td>
                    <td>
                        <a v-if="editRole" :href="`/portal/roles/${role.id}/edit`"><i class="fa fa-pencil-square-o"></i></a>
                        <a v-if="delRole" @click.prevent="confirmDestroyRole(role.id)" href="#"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</template>

<script>
    import {HttpService} from "../../services/HttpService";
    import Swal from "sweetalert2";
    export default {
        props:['editRole','delRole'],
        data(){
            return {
                service: new HttpService(),
                roles:[],
                loading:false,
            }
        },

        created() {
            this.getRoles();
        },

        methods:{
            async getRoles(){
                try {
                    this.loading = true;
                    const rolePromise = await this.service.setBaseUrl().get(`roles/get-list`, {})
                    this.loading = false
                    if(rolePromise.success){
                        this.roles = rolePromise.data;
                    }
                } catch(error) {
                    this.loading = false
                }
            },

            confirmDestroyRole(id){
                let self = this;
                Swal.fire({
                    title: "Are you sure you want to delete this role?",
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Yes"
                }).then((result) => {
                    if (result.value) {
                        self.deleteRole(id);
                    }
                });

            },

            async deleteRole(id){
                try {
                    this.loading = true;
                    const rolePromise = await this.service.setBaseUrl().delete(`roles/${id}`)
                    this.loading = false
                    this.getRoles();

                } catch(error) {
                    this.loading = false
                    Swal.fire('Error', 'Something went wrong', "error");
                }
            }


        }
    }
</script>
