@if($active_game)
@section('content')
<div class="col-lg-3">
	<div class="panel panel-info">
	  	<div class="panel-heading">
	    	<h3 class="panel-title">Game Status</h3>
	  	</div>
	  	<div class="panel-body">
	  		<span class="btn btn-inverse btn-lg col-lg-12"><b id="game_stat_name">{{$active_game->name}}</b></span>
	  		<span class="btn btn-inverse btn-lg col-lg-12"><b>TIME</b><br><span id="game_stat_remaining">0 second</span> remaining</span>
	  	</div>
	</div>
</div>
<div class="col-lg-6">
	<div class="text-center current-word">
		Current Word<br>
		<span>{{$active_game->word}}</span>
	</div>
	<form action="" method="post" class="player-form" autocomplete="off">
		<div class="col-lg-12">
			<p class="help-block text-center text-italic">Enter word and press Enter (Minimum: {{$active_game->minimum_letter}})</p>
			<input class="form-control input-lg text-center" type="text" name="word" id="word_input" />
		</div>
		<button class="hidden btn btn-success btn-lg col-lg-3" type="submit">ADD</button>
	</form>

    <div class="word_alert alert alert-success hidden"></div>
    <div class="word_alert alert alert-danger hidden"></div>

	<div class="{{($active_game_data)?'':'hidden'}} wordlist panel panel-primary">
	  	<div class="panel-heading">
		    @if($active_game_data)
		    <?php $wordlist = unserialize($active_game_data->words); ?>
	    	<h3 class="panel-title text-right">Counter: <span class="counter">{{sizeof($wordlist)}}</span> words</h3>
	    	@else
	    	<h3 class="panel-title text-right">Counter: <span class="counter">0</span> word</h3>
	    	@endif
	  	</div>
	  	<div class="panel-body">
	    	<ol class="thelist">
			    @if($active_game_data)
			    <?php $wordlist = unserialize($active_game_data->words); ?>
	    		@foreach($wordlist as $w)
	    		<li>{{$w}}</li>
	    		@endforeach
	    		@endif
	    	</ol>
	  	</div>
	</div>

</div>
<div class="col-lg-3">
	<div class="panel panel-success">
	  	<div class="panel-heading">
	    	<h3 class="panel-title">Score Overview</h3>
	  	</div>
	  	<div class="panel-body">
	  		<table class="table table-hover">
	  			<?php
	  			$game_data = GameData::where('user_id','=',Auth::user()->id)->orderby('created_at', 'asc')->get();
	  			$total = 0;
	  			foreach($game_data as $gd) :
	  				$game = Game::find($gd->game_id);
	  				$total += $gd->point;
	  			?>
	  			<tr>
	  				<td>{{$game->name}}</td>
	  				<td><b>{{$gd->point}}</b></td>
	  			</tr>
	  			<?php endforeach; ?>
	  			<tr>
	  				<td>Total Score</td>
	  				<td><b>{{$total}}</b></td>
	  			</tr>
	  		</table>
	  	</div>
	</div>
</div>
@stop

@section('script')
<script type="text/javascript">
var remainingInterval;
var minimum_letter = {{$active_game->minimum_letter}};

$(function(){
	var word = "{{$active_game->word}}".toUpperCase();
	var word_length = word.length;
	var allowedChars = [];
	var typedKey = [];
	// var ascii = [65=>'A',66=>'B', 67=>'C', 68=>'D', 'E'=>69, 'F'=>70, 'G'=>71, 'H'=>72, 'I'=>73, 'J'=>74, 'K'=>75, 'L'=>76, 'M'=>77, 'N'=>78, 'O'=>79, 'P'=>80, 'Q'=>81, 'R'=>82, 'S'=>83, 'T'=>84, 'U'=>85, 'V'=>86, 'W'=>87, 'X'=>88, 'Y'=>89, 'Z'=>90];
	// var ascii = {'A':65,'B':66, 'C':67, 'D':68, 'E':69, 'F':70, 'G':71, 'H':72, 'I':73, 'J':74, 'K':75, 'L':76, 'M':77, 'N':78, 'O':79, 'P':80, 'Q':81, 'R':82, 'S':83, 'T':84, 'U':85, 'V':86, 'W':87, 'X':88, 'Y':89, 'Z':90}

	for(k=0;k<word_length;k++)
	{
		chr = word.substr(k, 1);
		allowedChars.push(chr);
	}

	$('.player-form').on('submit', function(e){
		e.preventDefault();
		
		$('.word_alert').addClass('hidden');
		
		// Validation of minimum letter
		if( $("#word_input").val().length < minimum_letter )
		{
			$('.word_alert.alert-danger').text('"'+$("#word_input").val().toUpperCase()+'" should be atleast '+minimum_letter+' letters.').removeClass('hidden');
			$('#word_input').val('');
			return false;
		}
		else if( $("#word_input").val().length >= minimum_letter )
		{
			// Allowed character
			input_word = $("#word_input").val().toUpperCase();
			input_word_length = input_word.length;
			
			for(k=0;k<input_word_length;k++)
			{
				input_char = input_word.substr(k, 1);
				found = allowedChars.indexOf(input_char.toString());
				if(found < 0)
				{
					$('.word_alert.alert-danger').text('"'+$("#word_input").val().toUpperCase()+'" contain invalid letter.').removeClass('hidden');
					$('#word_input').val('');
					return false;
				}
			}

			// Check valid word. Only letters in the word are allowed.
			for(k=0;k<input_word_length;k++)
			{
				input_char = input_word.substr(k, 1);
				
				var rgxp = new RegExp(input_char.toString(), "g");

				var l1 = (word.match(rgxp)||[]).length;
				var l2 = (input_word.match(rgxp)||[]).length;

				if(l1 < l2)
				{
					if(l1 > 1)
					{
						$('.word_alert.alert-danger').html('"'+$("#word_input").val().toUpperCase()+'" can have "<b>'+input_char+'</b>" only '+l1+' times.').removeClass('hidden');
						$('#word_input').val('');
					}
					else
					{
						$('.word_alert.alert-danger').html('"'+$("#word_input").val().toUpperCase()+'" can have "<b>'+input_char+'</b>" only '+l1+' time.').removeClass('hidden');
						$('#word_input').val('');
					}
					return false;
				}
			}

			// Dictionary validation
			$.ajax({
				url: '/dictionary/'+$("#word_input").val(),
				type:'get',
				async:false
			})
			.done(function(result){
				if(result == 'invalid')
				{
					$('.word_alert.alert-danger').text('"'+$("#word_input").val().toUpperCase()+'" not found in dictionary.').removeClass('hidden');
					$('#word_input').val('');
				}
				else
				{
					// Validate distinct
					$.ajax({
						url: '/distinctword/'+$("#word_input").val(),
						type: 'get',
						async: false
					})
					.done(function(result){
						if(result == 'invalid')
						{
							$('.word_alert.alert-danger').text('"'+$("#word_input").val().toUpperCase()+'" already submitted.').removeClass('hidden');
							$('#word_input').val('');
						}
						else
						{
							var formdata = $('.player-form').serialize();
		
							$.ajax({
								url: '/',
								type:'post',
								data: formdata,
								beforeSend: function(){
									$('#word_input').val('');
								}
							})
							.done(function(result){
								if(typeof result.success != 'undefined')
								{
									$('.word_alert.alert-success').text(result.success).removeClass('hidden');
									$('.wordlist .thelist').append('<li>'+result.word+'</li>');
									$('.wordlist .counter').text(result.score);
									$('.wordlist').removeClass('hidden');
								}
								else if(typeof result.failure != 'undefined')
								{
									$('.word_alert.alert-danger').text(result.failure).removeClass('hidden');
								}
							});
						}
					});

				}
			});
		}
	});

	remaining();
	remainingInterval =setInterval("remaining()", 1000);

});

function remaining()
{
	$.ajax({
		url: '/remaining',
		async: false
	})
	.done(function(result){
		if(typeof result.remaining != 'undefined')
		{
			if(parseInt(result.remaining) > 1)
				$('#game_stat_remaining').text(result.remaining + ' seconds');
			else
				$('#game_stat_remaining').text(result.remaining + ' second');
			
			if(parseInt(result.remaining) <= 1)
			{
				clearInterval(remainingInterval);
				window.location.href = '/result';
			}
		}
		else
		{
			clearInterval(remainingInterval);
			window.location.href = '/result';
		}
	});
}
</script>
@stop

@else

@section('content')
<div class="col-lg-4"></div>
<div class="col-lg-4 nogame">
	<div class="panel panel-info">
	  	<div class="panel-heading">
	    	<h3 class="panel-title">No Active Game</h3>
	  	</div>
	  	<div class="panel-body">
	  		<span class="btn btn-inverse btn-lg col-lg-12 wait"><b>Please wait</b></span>
	  		<span class="btn btn-inverse btn-lg col-lg-12 timeticker hidden">Game will start in <b>30 seconds</b></span>
	  	</div>
	</div>
</div>
<div class="col-lg-4"></div>
@stop

@section('script')
<script type="text/javascript">
var intval;

$(function(){
	gamestart();
	intvl =setInterval("gamestart()", 1000);
});

function gamestart()
{
	$.ajax({
		url: '/gamestart',
		async: false
	})
	.done(function(result){
		if(typeof result.timeleft != 'undefined')
		{
			if(parseInt(result.timeleft) > 1)
				$('.timeticker b').text(result.timeleft + ' seconds');
			else
				$('.timeticker b').text(result.timeleft + ' second');
			
			$('.timeticker').removeClass('hidden');
			$('.wait b').text('Game will start automatically.');
			$('.nogame .panel-title').text(result.gamename);

			if(parseInt(result.timeleft) <= 1)
			{
				clearInterval(intval);
				window.location.reload();
			}
		}
	});
}
</script>
@stop

@endif