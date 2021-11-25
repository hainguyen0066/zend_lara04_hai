@component('mail::message')
    ## You have a new customer
    ## Name: {{$details['name']}}
    ## Email: {{$details['email']}}
    ---
    ###
    ### Phone:
    # {{$details['phone']}}
    ---
    ### Message:
    # {{$details['message']}}
@endcomponent
