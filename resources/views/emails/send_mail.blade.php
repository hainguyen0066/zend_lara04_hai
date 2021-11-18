<style>
    .test-mail {
        width: 500px;
        margin: 0 auto;
        padding: 15px;
        text-align: center;
    }
</style>
<div class="text-mail">
    <h2>Hi {{ $details['name'] }}</h2>
    <h2>Hi {{ $details['email'] ?? '' }}</h2>
    <h2>Hi {{ $details['phone'] ?? '' }}</h2>
    <h2>Hi {{ $details['message']?? '' }}</h2>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aliquid cumque deleniti dolorum hic id laborum, natus nesciunt possimus quae quaerat quia quibusdam recusandae repellat reprehenderit sit totam. Cumque, sapiente.
    </p>
</div>
