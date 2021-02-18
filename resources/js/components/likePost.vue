<template>
    <div>
        <button type="submit" style="background: none; border: none; color: inherit">
            <i class="fa fa-thumbs-up" style="font-size: 20px"></i>
        </button>
    </div>
</template>

<script>
export default {
name: "likePost",
    props: [
      'userId',
      'postId'
    ],


}
</script>

<style scoped>

</style>
