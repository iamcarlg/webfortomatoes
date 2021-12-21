<?php

class Db_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();

        }

        // Fonction qui permet d'avoir tous les comptes qui sont dans la table
        public function get_all_compte()
        {
            $query = $this->db->query("SELECT cpt_login FROM t_compte_cpt;");
            return $query->result_array();
            
        }

        // Fonction qui permet d'avoir toutes les actualités postées récemment et dans la limite de 5
        public function get_actualite()
        {
            // $query = $this->db->query("SELECT act_id,  act_titre, act_descriptif, act_date, act_date FROM t_actualite_act WHERE
            // act_id=".$numero.";");

            $query = $this->db->query("SELECT DISTINCT act_titre, act_descriptif, act_date, act_etat, cpt_login FROM t_actualite_act
            JOIN t_organisateur_org USING (org_id)
            WHERE act_etat = 1
            ORDER BY act_date DESC LIMIT 5;");

            return $query->result_array();

        }

        // Fonction qui permet d'avoir toutes les programmations des animations avec les différents invités associés
        public function get_all_programmation()
        {
            // SELECT cpt_login, ani_id, ani_intitule, ani_horairedebut,ani_horairefin, lie_nom, inv_nom, inv_discipline FROM t_animation_ani
            // LEFT JOIN t_lieu_lie USING (lie_id)
            // LEFT JOIN t_intervention_int USING (ani_id)
            // LEFT JOIN t_invite_inv USING (inv_id)
            // ORDER BY ani_horairefin ASC;

            $query = $this->db->query("CALL get_all_programmation();");
            
            return $query->result_array();
        }

        // Fonction qui permet d'avoir l'ensemble des invités ainsi que les posts associés à ces invités et leurs liens vers les réseaux sociaux
        public function get_all_invite()
        {
            
            $query = $this->db->query("SELECT * FROM t_invite_inv
            LEFT OUTER JOIN t_compte_cpt USING (cpt_login)
            LEFT OUTER JOIN t_reseau_res USING (inv_id)
            LEFT OUTER JOIN t_passeport_pas USING (inv_id)
            LEFT OUTER JOIN t_post_pos USING (pas_id)
            LEFT OUTER JOIN t_url_url USING (url_id)
            WHERE cpt_etat = 1
            GROUP BY pos_libelle, inv_nom
            ORDER BY pos_datepost DESC;");

            return $query->result_array();

        }

        // Fonction qui permet de récupérer tous les urls de la table des invités
        public function get_all_url()
        {
            $query = $this->db->query("SELECT inv_nom, url_hyperlien FROM t_invite_inv
            LEFT OUTER JOIN t_reseau_res USING (inv_id)
            LEFT OUTER JOIN t_passeport_pas USING (inv_id)
            LEFT OUTER JOIN t_post_pos USING (pas_id)
            LEFT OUTER JOIN t_url_url USING (url_id)
            GROUP BY url_hyperlien
            ORDER BY inv_nom DESC;");

            return $query->result_array();

        }

        // Fonction qui permet de récupérer tous les posts de la table des invités
        public function get_all_post()
        {
            $query = $this->db->query("SELECT inv_nom, pos_libelle, pos_datepost, pos_etat FROM t_invite_inv
            LEFT OUTER JOIN t_reseau_res USING (inv_id)
            LEFT OUTER JOIN t_passeport_pas USING (inv_id)
            LEFT OUTER JOIN t_post_pos USING (pas_id)
            LEFT OUTER JOIN t_url_url USING (url_id)
            GROUP BY url_hyperlien
            ORDER BY inv_nom DESC;");

            return $query->result_array();

        }

        // Fonction qui permet d'afficher tous les lieux de l'événement
        public function get_all_lieu(){
            // $query = $this->db->query("SELECT * FROM t_lieu_lie
            // LEFT JOIN t_service_ser USING (lie_id)");

            $query = $this->db->query("SELECT * FROM tousLieux;");

            return $query->result_array();
            
        }

        // Fonction qui permet d'afficher tous les services de l'événement
        public function get_all_service($id){
            $query = $this->db->query("SELECT ser_id, ser_type FROM t_service_ser
            WHERE lie_id = '".$id."'
            ;");
    
            return $query->result_array();
            
        }

        // Fonction qui permet d'insérer des données dans un formulaire de connexion à l'aide d'un pseudo et un mot de passe
        public function set_compte()
        {
            $this->load->helper('url');
            
            $id=$this->input->post('id');
            $mdp=$this->input->post('mdp');


            // On rajoute du sel
            $salt = "123CarlBurundi";

            // Hashage du mot de passe entré dans le formulaire d'inscription
            $mdp = hash('sha256', $salt.$mdp);

            $req="INSERT INTO t_compte_cpt VALUES ('".$id."','".$mdp."', 'I', 0);";

            $query = $this->db->query($req);
            return ($query);

        }

        // // Fonction qui met par défaut l'utilisateur qui crée son compte dans la table des invités
        // public function set_invite_par_defaut()
        // {
        //     $this->load->helper('url');
            
        //     $id=$this->input->post('id');

        //     $req="INSERT INTO t_invite_inv VALUES (1,NULL,NULL, NULL, '".$id."');";

        //     $query = $this->db->query($req);
        //     return ($query);

        // }


        // Fonction qui permet de me connecter à l'aide d'un pseudo et d'un mot de passe
        public function connect_compte($username, $password, $etat)
        {
            $etat = 1; // Etat actif
            $query =$this->db->query("SELECT cpt_login,cpt_password
            FROM t_compte_cpt
            WHERE cpt_login='".$username."' AND cpt_password='".$password."' AND cpt_etat = '".$etat."';");

            // Si la récupération du nombre de lignes dans la table des comptes est égale à 1
            if($query->num_rows() > 0)
            {
                return true;
            }

            else{
                return false;
            } 

        }

        // Requete qui récupère le statut de l'utilisateur qui souhaite se connecter
        public function get_compte_statut($username){
            $query1 =$this->db->query("SELECT * FROM t_organisateur_org
            WHERE cpt_login='".$username."';");

            $query2 =$this->db->query("SELECT * FROM t_invite_inv
            WHERE cpt_login='".$username."';");

            if($query1->num_rows() > 0){
                return "Organisateur";

            }

            if($query2->num_rows() > 0){
                return "Invite";
            }

        }

        // Fonction de visualisation des caractéristiques de l'invité connecté
        public function visualiser_profil_invite($username)
        {

            $query = $this->db->query("SELECT cpt_login, inv_nom, inv_photo, inv_discipline, url_hyperlien FROM t_compte_cpt
                                    LEFT JOIN t_invite_inv USING (cpt_login)
                                    LEFT JOIN t_reseau_res USING (inv_id)
                                    LEFT JOIN t_url_url USING (url_id)
                                    WHERE cpt_login = '".$username."';");

            return $query->row();

        }

        // Fonction de visualisation des caractéristiques de l'administrateur connecté
        public function visualiser_profil_admin($username)
        {

            $query = $this->db->query("SELECT cpt_login, org_nom, org_prenom, org_mail, org_adresse FROM t_compte_cpt
                                    JOIN t_organisateur_org USING (cpt_login)
                                    WHERE cpt_login = '".$username."' AND cpt_statut = 'A';");

            return $query->row();

        }

        // Fonction de modification du mot de passe
        public function check_password($username, $password){

            $query = $this->db->query("UPDATE t_compte_cpt
                                    SET cpt_password = '".$password."' 
                                    WHERE cpt_login = '".$username."';");

            return $query;
        }

        // Fonction de récupération des infos de l'organisateur connecté
        public function organisateur_info($username){
            $query = $this->db->query("SELECT cpt_login, org_nom, org_prenom, org_mail, org_adresse FROM t_compte_cpt
                                    JOIN t_organisateur_org USING (cpt_login)
                                    WHERE cpt_login = '".$username."' AND cpt_statut = 'A';");

            return $query->row();
        }

        // Fonction de récupération des infos de l'invité connecté
        public function invite_info($username){
            $query = $this->db->query("SELECT cpt_login, inv_nom, inv_discipline, inv_photo FROM t_compte_cpt
                                    JOIN t_invite_inv USING (cpt_login)
                                    WHERE cpt_login = '".$username."' AND cpt_statut = 'I';");

            return $query->row();
        }

        // Requete de récupération de tous les passeports et posts de l'utilisateur connecté
        public function tous_les_passeports_posts($username){
            $query = $this->db->query("SELECT pas_login, pas_etat, pos_libelle, pos_datepost, pos_etat FROM t_invite_inv
            LEFT OUTER JOIN t_passeport_pas USING (inv_id)
            LEFT OUTER JOIN t_post_pos USING (pas_id)
            WHERE cpt_login = '".$username."'
            ORDER BY pos_datepost DESC;");

            return $query->result_array();
        }

        // Requete de récupération d'un pass ID pour l'affecter au pseudo Passeport entré en saisie
        public function get_pas_id($pas_login){
            $query = $this->db->query("SELECT pas_id FROM t_passeport_pas WHERE pas_login = '".$pas_login."';");

            return $query->row();

        }

        // Requete de vérification du couple de codes dans la base de données
        public function passeport_connect($pas_login, $pas_mdp){
                    $query = $this->db->query("SELECT * FROM `t_passeport_pas` 
                    JOIN t_invite_inv USING (inv_id) WHERE pas_login = '".$pas_login."' and pas_mdp = '".$pas_mdp."';");
        
                    return $query->row();
                }

                
        // Requete d'ajout d'un post par un invité connecté
        public function ajout_post($pas_id, $pos_texte){
                $req = "INSERT INTO t_post_pos VALUES(NULL, '".$pos_texte."', curdate(), 1, ".$pas_id.");";
                
                $query = $this->db->query($req);
                return ($query);

        
        }

        // Fonction qui récupère l'ID d'une animation séléctionnée
        public function get_all_animation($id)
        {
            $query = $this->db->query("SELECT * from t_animation_ani where ani_id='".$id."';");
            return $query->row();
        }

        public function get_all_inv($id){

            $query = $this->db->query("SELECT * FROM t_invite_inv
            LEFT OUTER JOIN t_intervention_int USING (inv_id)
            LEFT OUTER JOIN t_animation_ani USING (ani_id)
            LEFT OUTER JOIN t_reseau_res USING (inv_id)
            LEFT OUTER JOIN t_passeport_pas USING (inv_id)
            LEFT OUTER JOIN t_post_pos USING (pas_id)
            LEFT OUTER JOIN t_url_url USING (url_id)
            WHERE ani_id = '".$id."'
            GROUP BY url_hyperlien
            ORDER BY inv_nom DESC;");

            return $query->result_array();

        }

        public function get_all_lieu_id($id)
        {
            $query = $this->db->query("SELECT * FROM t_lieu_lie
                                    LEFT JOIN t_animation_ani USING (lie_id)
                                    LEFT JOIN t_service_ser USING (lie_id)
                                    WHERE ani_id = '".$id."';");
            return $query->result_array();
        }

        public function get_all_service_id($id)
        {
            $query = $this->db->query("SELECT * FROM `t_service_ser` WHERE lie_id = '".$id."';");
            return $query->result_array();

        }

        public function get_all_url_pseudo($username)
        {
            // $query = $this->db->query("SELECT * FROM t_invite_inv
            //                         LEFT JOIN t_reseau_res USING (inv_id)
            //                         LEFT JOIN t_url_url USING (url_id)
            //                         WHERE cpt_login = '".$username."';");

            $query = $this->db->query("CALL get_all_url_pseudo('".$username."');");

            return $query->result_array();
        }

        // Requête récupérant toutes les données de toutes les animations
        public function get_all_animations($username){
            // $query = $this->db->query("SELECT * FROM t_animation_ani;");
            $query = $this->db->query("CALL get_all_animations();");

            return $query->result_array();

        }

        // Requete de suppression d'une animation séléctionnée
        public function delete_intervention_selected($ani_id){

             $req = "DELETE FROM t_intervention_int WHERE ani_id = '".$ani_id."';";
            $req2 = "DELETE FROM t_animation_ani WHERE ani_id = '".$ani_id."';";

            $query = $this->db->query($req);
            $query2 = $this->db->query($req2);


            return ($query);
            return ($query2);

        }

        // Requete de mise à jour d'une animation séléctionnée
        public function update_animation_selected($ani_id){

            $this->db->update('t_intervention_int', array('ani_id' => $ani_id));
            
            $tables = array('t_intervention_int', 't_animation_ani');
            $this->db->where('ani_id', $ani_id);
            $this->db->delete($tables);
            
        }

        // Requete avec fonction SQL qui compte le nombre d'invités au total
        public function nombre_invite_total(){

            $query = $this->db->query("SELECT nombre_invite_total() as nombre_invite;");
            return $query->row();

        }

        // Requete avec VUE SQL qui compte le nombre d'invités au total
        public function visualiser_toutes_programmations(){

            $query = $this->db->query("SELECT * FROM montre;");

            return $query->row();

        }



    }

?>
