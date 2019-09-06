<?php

require_once( __DIR__ . '/ModuleDesWidgetInterface.php' );

class ModuleDesClasse extends WP_Widget implements ModuleDesWidgetInterface
{
	function __construct()
	{
		// parent::__construct($id_base, $name, $widget_options = array(), $control_options = array());
		parent::__construct(
			'module_des_widget', // Base ID
			esc_html__( 'Module Dés', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'Un module de lancé de dés', 'text_domain' ), ) // Args
		); 
	}

	// la fonction form permet de créer le formulaire de paramétrage du widget
    // ici j'ai 2 paramètres : le nom du widget et la liste des dés que l'on peut lancer
	public function form($instance)
	{
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Lancé de dés', 'text_domain' );
		// $attributForToLabelTag = esc_attr( $this->get_field_id( 'title' ) );
		// $contentToLabelTag = esc_attr_e( 'Title:', 'text_domain' );
		// $attributIdToInputTag = esc_attr( $this->get_field_id( 'title' ) );
		// $attributNameToInputTag = esc_attr( $this->get_field_name( 'title' ) );
		// $attributValueToInputTag = esc_attr( $title );
		$output = "<p>";
		$output .= "<label for=".esc_attr( $this->get_field_id( 'title' ) ).">".esc_attr_e( 'Title:', 'text_domain' )."</label>";
		$output .= "<input class=\"widefat\" id=".esc_attr( $this->get_field_id( 'title' ) )." name=".esc_attr( $this->get_field_name( 'title' ) )." type=\"text\" value=".esc_attr( $title ).">";
		$output .= "</p>";
		echo $output; 
	}

	// Fonction définissant un peu de css
	public function css()
	{

	} 

	// Cette fonction contient le corps du module, c'est en appelant cette méthode qu'on affiche le widget
    public function widget($args, $instance)
    {
    	echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		echo <<<FORMULAIRE
		<div id="gameplay">
			<!-- <form action="" method="GET"> -->
				<input type="button" name="d2" value="d2">
				<input type="button" name="d4" value="d4">
				<input type="button" name="d6" value="d6">
				<input type="button" name="d8" value="d8">
				<input type="button" name="d10" value="d10">
				<input type="button" name="d12" value="d12">
				<input type="button" name="d20" value="d20">
				<input type="button" name="d100" value="d100">
				<input type="submit" name="submit" value="submit">
	       	<!-- </form> -->
	    </div>
	    <div>
        	<h3>Somme des lancés : <span id="result"></span></h3>
        </div>
        <script>
        	var DiceObject = function(name = "d2", nbrFace = 2) {
        		this.name = name;
        		this.nbrFace = nbrFace;
        		this.launched = function() {
        			return Math.floor(Math.random() * (this.nbrFace)) + 1; 
        		};
        	};

        	var arrayResult = [];
        	var sumAllDicesLaunched = function(results) {
        		var sum = 0;
        		for (var i=0; i < results.length; i++) {
        			if (sum == 0) {
        				sum = results[i];	
        			}
        			else {
        				sum += results[i];
        			} 
        		}

        		return sum;
        	};

        	document.querySelector("[name=d2]").addEventListener("click", function(){
        		let dice = new DiceObject();
        		arrayResult.push(dice.launched());
        		console.log(arrayResult);
        		// document.getElementById("result").innerHTML = dice.launched();
        	});

        	document.querySelector("[name=d4]").addEventListener("click", function(){
        		let dice = new DiceObject("d4", 4);
        		arrayResult.push(dice.launched());
        		console.log(arrayResult);
        		// document.getElementById("result").innerHTML = dice.launched();
        	});	

        	document.querySelector("[name=d6]").addEventListener("click", function(){
        		let dice = new DiceObject("d6", 6);
        		arrayResult.push(dice.launched());
        		console.log(arrayResult);
        		// document.getElementById("result").innerHTML = dice.launched();
        	});

        	document.querySelector("[name=d8]").addEventListener("click", function(){
        		let dice = new DiceObject("d8", 8);
        		arrayResult.push(dice.launched());
        		console.log(arrayResult);
        		// document.getElementById("result").innerHTML = dice.launched();
        	});

        	document.querySelector("[name=d10]").addEventListener("click", function(){
        		let dice = new DiceObject("d10", 10);
        		arrayResult.push(dice.launched());
        		console.log(arrayResult);
        		// document.getElementById("result").innerHTML = dice.launched();
        	});

        	document.querySelector("[name=d12]").addEventListener("click", function(){
        		let dice = new DiceObject("d12", 12);
        		arrayResult.push(dice.launched());
        		console.log(arrayResult);
        		// document.getElementById("result").innerHTML = dice.launched();
        	});

        	document.querySelector("[name=d20]").addEventListener("click", function(){
        		let dice = new DiceObject("d20", 20);
        		arrayResult.push(dice.launched());
        		console.log(arrayResult);
        		// document.getElementById("result").innerHTML = dice.launched();
        	});

        	document.querySelector("[name=d100]").addEventListener("click", function(){
        		let dice = new DiceObject("d100", 100);
        		arrayResult.push(dice.launched());
        		console.log(arrayResult);
        		// document.getElementById("result").innerHTML = dice.launched();
        	});

        	var resultat;
    //     	document.querySelector("[type=submit]").addEventListener("click", function(){
				// resultat = sumAllDicesLaunched(arrayResult);
				// var xmlhttp = new XMLHttpRequest();
    // 			xmlhttp.onreadystatechange = function() {
    //   				if (this.readyState == 4 && this.status == 200) {
    //     				document.getElementById("result").innerHTML = this.responseText;
    //     				// document.getElementById("result").innerHTML = resultat;
    //   				}
    // 			};
    // 			xmlhttp.open("GET", "moduleDes.php?submit=submit&q=" + resultat, true);
    // 			xmlhttp.send();
				// console.log(this.responseText);
    //     	});
        	document.querySelector("[type=submit]").addEventListener("click", function(){
				resultat = sumAllDicesLaunched(arrayResult);
        		document.getElementById("result").innerHTML = resultat;
				console.log(resultat);
        	});
        </script>
FORMULAIRE;
		echo $args['after_widget'];
    }

    // Cette methode me permet de créer la table qui stockera tous les jets réalisés
    public static function install()
    {
    	add_option('jets', 0);
    }

    // Cette méthode supprime la table de stockage des jets
	public static function uninstall()
	{
		delete_option('jets');
	}

	// Cette fonction me permet de renvoyer un tableau contenant $nb nombres compris entre 0 et $max
	public static function alea($max, $nb)
	{

	}

	// C'est dans cette fonction que je détermine le comportement de mon shortcode
	public static function liste_jets($atts, $content)
	{

	}

	// C'est dans cette methode que je vais stocker les éléments des jets
    public static function traitement()
    {

    }

    /**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) 
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

}