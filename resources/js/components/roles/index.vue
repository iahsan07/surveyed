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
                        <a :href="`/portal/roles/${role.id}/edit`"><i class="fa fa-pencil-square-o"></i></a>
                        <a href=""><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</template>

<script>
    import {HttpService} from "../../services/HttpService";
    export default {
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
        }
    }
</script>
