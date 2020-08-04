<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/home" class="nav-item nav-link">Home</router-link>
                    <router-link to="/add" class="nav-item nav-link">Add Book</router-link>
                </div>
            </div>
        </nav>
        <br/>
        <h3 class="text-center">All Books</h3><br/>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Author</th>
                <th>Price</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="book in books" :key="book.id">
                <td>{{ book.id }}</td>
                <td>{{ book.book_name }}</td>
                <td>{{ book.author }}</td>
                <td>{{ book.price }}</td>
                <td>{{ book.description }}</td>
                <td>{{ book.created_at }}</td>
                <td>{{ book.updated_at }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: book.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteBookSoft(book.id)">Soft-Delete</button>
                        <button class="btn btn-primary" @click="deleteBookHard(book.id)">Hard-Delete</button>

                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                books: []
            }
        },
        created() {
            let token = localStorage.getItem('auth_token');
            this.axios
                .get('http://localhost:8000/api/books/get' , {
                    headers:{
                        'Authorization': `Bearer ${token}` 
                    }
                })
                .then(response => {
                    this.books = response.data;
                });
        },
        methods: {
            
            deleteBookSoft(id) {
                let token = localStorage.getItem('auth_token');
                this.axios
                    .delete(`http://localhost:8000/api/books/delete/soft/${id}`,{
                    headers:{
                        'Authorization': `Bearer ${token}` 
                    }
                })
                    .then(response => {
                        let i = this.books.map(item => item.id).indexOf(id); // find index of your object
                        this.books.splice(i, 1)
                    });
            },
            deleteBookHard(id) {
                this.axios
                    .delete(`http://localhost:8000/api/books/delete/hard/${id}`,{
                    headers:{
                        'Authorization': `Bearer ${token}` 
                    }
                })
                    .then(response => {
                        let i = this.books.map(item => item.id).indexOf(id); // find index of your object
                        this.books.splice(i, 1)
                    });
            }
        }
    }
</script>