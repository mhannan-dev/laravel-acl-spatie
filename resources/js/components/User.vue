<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Users
                        <a @click="newModal()" type="button" data-bs-toggle="modal" data-bs-target="#newModal"
                            class="float-right btn btn-primary text-white"><i
                                class="nav-icon fas fa-plus-circle text-white"></i>
                            User</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Actios</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(user, index) in users" :key="index">
                                    <th scope="row">{{ ++index }}</th>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.type | uppercase() }}</td>
                                    <td>{{ user.created_at | moment("MMMM Do YYYY") }}</td>
                                    <td>
                                        <a @click="editModal(user)" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button @click.prevent="deleteUser(user.id)" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash text-white"></i>
                                        </button>
                                    </td>

                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form @submit.prevent="editMode ? updateUser() : createUser()" @keydown="form.onKeydown($event)">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editMode" class="modal-title" id="newModalLabel">
                                Input User Information
                            </h5>
                            <h5 v-show="editMode" class="modal-title" id="newModalLabel">
                                Update User Information
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Full name</label>
                                <input type="text" class="form-control" v-model="form.name"
                                    placeholder="Enter full name" autofocus />

                                <HasError :form="form" field="name" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email" class="form-control" v-model="form.email" placeholder="Enter email"
                                    autofocus />
                                <HasError :form="form" field="email" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" v-model="form.password"
                                    placeholder="Enter password" autofocus />
                                <HasError :form="form" field="password" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Type</label>
                                <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example"
                                    v-model="form.type">
                                    <option value="">-- Select Role --</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">
                                        Standard User
                                    </option>
                                    <option value="author">Author</option>
                                </select>
                                <HasError :form="form" field="type" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Bio Information</label>
                                <textarea class="form-control" rows="3" placeholder="Enter user information"
                                    v-model="form.bio"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Upload Photo</label>
                                <input class="form-control" type="file" id="formFile" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button v-show="editMode" type="submit" class="btn btn-success text-white">
                                Update
                            </button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary">
                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Form from "vform";
export default {
    data() {
        return {
            editMode: false,
            users: [],
            form: new Form({
                id: "",
                name: "",
                email: "",
                type: "",
                bio: "",
                photo: "",
                password: "",
            })
        };
    },
    methods: {
        updateUser() {
            this.$Progress.start()
            this.form.put('api/user/' + this.form.id)
                .then(() => {
                    $('#newModal').modal('hide');
                    Toast.fire({
                        type: 'success',
                        title: 'User updated successfully'
                    })
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');

                })
                .catch(error => {
                    this.$Progress.fail();
                })
        },
        editModal(user) {
            this.editMode = true;
            this.form.reset();
            $('#newModal').modal('show');
            this.form.fill(user);
        },
        newModal() {
            this.editMode = false;
            this.form.reset();
            $('#newModal').modal('show');
        },
        loadUsers() {
            axios.get("api/user")
                .then((data) => {
                    this.users = data.data;
                })
                .catch((error) => console.log(error.data));
        },
        deleteUser(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete("api/user/" + id)
                        .then(() => {
                            if (result.value) {
                                Swal.fire("Deleted!", "Your data has been deleted.", "success");
                            }
                        })
                }
                Fire.$emit('AfterCreate');
            }).catch(() => {
                Swal.fire("Failed!", "There is something wrong", "warning");
            });
        },
        createUser() {
            this.$Progress.start()
            this.form.post("api/user")
                .then(() => {
                    Fire.$emit('AfterCreate');
                    $('#newModal').modal('hide');
                    Toast.fire({
                        type: 'success',
                        title: 'User created successfully'
                    })
                    this.$Progress.finish();

                })
                .catch(error => {
                    console.log('error', error)
                })
        }
    },

    created() {
        this.loadUsers();
        //setInterval(() =>this.loadUsers(), 4000);
        Fire.$on('AfterCreate', () => {
            this.loadUsers();
        })
    }
}
</script>
