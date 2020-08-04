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
        <h3 class="text-center">Edit Book</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateBook">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="book.book_name">
                    </div>
                    <div class="form-group">
                        <label>Author</label>
                        <input type="text" class="form-control" v-model="book.author">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" v-model="book.price">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" v-model="book.description">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Book</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                book: {}
            }
        },
        created() {
            let token = localStorage.getItem('auth_token');
            this.axios
                .get(`http://localhost:8000/api/books/edit/${this.$route.params.id}`,{
                    headers:{
                        'Authorization': `Bearer ${token}` 
                    }
                })
                .then((response) => {
                    this.book = response.data;
                    // console.log(response.data);
                });
        },
        methods: {
            updateBook() {
                let token = localStorage.getItem('auth_token');
                this.axios
                    .post(`http://localhost:8000/api/books/update/${this.$route.params.id}`, this.book,{
                    headers:{
                        'Authorization': `Bearer ${token}` 
                    }
                })
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    });
            }
        }
    }
</script>