<template>
<div>
  <span style="margin-right: 30px; cursor: pointer;" data-toggle="modal" @click="showLikes" :data-target="'#demo' + postId">Likes: {{ likes }}</span>

  <span style="cursor: pointer;" data-toggle="modal" :data-target="'#demo' + postId" @click="showComments">Comments: {{ comments }}</span>

  <div class="modal fade" :id="'demo' + postId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">{{ title }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div v-for="user in usersLikes" :key="user.id">
            {{ user.username }}
          </div>
          <div v-for="userComment in usersComments" :key="userComment.user.id">
            <div>
              <strong>{{ userComment.user.username }}</strong><br>
              <span>{{ userComment.content }}</span>
              <hr>
            </div>
          </div>
          <span>{{ noUsers }}</span>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
  export default {
    props: [
      'postId',
      'countLikes',
      'countComments'
    ],

    mounted() {
      // console.log('ok')
    },

    data() {
      return {
        usersLikes: [],
        usersComments: [],
        likes: this.countLikes,
        comments: this.countComments,
        title: '',
        noUsers: ''
      }
    },

    methods: {
      defaultValues() {
        this.usersLikes = [];
        this.usersComments = [];
        this.noUsers = '';
      },

      showLikes() {
        this.title = 'Likes';
        this.defaultValues();

        axios.get('/posts/'+ this.postId +'/likes')
              .then((response) => {
                if (response.data.users == 0)
                  this.noUsers = 'Be the first to like';

                response.data.users.map((value, key) => {
                  this.usersLikes.push(value);
                });
              })
      },

      showComments() {
        this.title = 'Comments';
        this.defaultValues();

        axios.get('/posts/'+ this.postId +'/comments')
              .then((response) => {
                // console.log(response.data)
                if (response.data == 0)
                  this.noUsers = 'Be the first to comment';

                response.data.map((value, key) => {
                  this.usersComments.push(value)
                });
              });
      }
    }
  }
</script>