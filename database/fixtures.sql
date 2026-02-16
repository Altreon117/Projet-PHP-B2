-- 1. On désactive la sécurité des clés étrangères
SET FOREIGN_KEY_CHECKS = 0;

-- 2. On VIDE les tables avec DELETE (au lieu de TRUNCATE)
DELETE FROM orders;
DELETE FROM invoice;
DELETE FROM stock;
DELETE FROM items;


-- 3. On remet les compteurs (ID) à 1 pour que ça fasse propre
ALTER TABLE orders AUTO_INCREMENT = 1;
ALTER TABLE invoice AUTO_INCREMENT = 1;
ALTER TABLE stock AUTO_INCREMENT = 1;
ALTER TABLE items AUTO_INCREMENT = 1;


-- 4. On réactive la sécurité
SET FOREIGN_KEY_CHECKS = 1;


-- ---------------------------------------------------------
-- INSERTIONS (Le reste ne change pas)
-- ---------------------------------------------------------

-- ARTICLES (ITEMS)
-- A. CONSOMMABLES
INSERT INTO items (nom, description_passive, description_stat, prix, categorie, image, stock, role, ad, crit_rate, attack_speed, physical_vamp, armor_penetration, ap, mana, magic_penetration, health, health_regeneration, armor, magic_resistance, tenacity, ability_haste, omnivamp, favoris) VALUES
('Potion Rechargeable', 'Consomme une charge pour restaurer 4,16 points de santé toutes les 0,5 secondes pendant 12 secondes', '+100 PV', 150, 'consumable', 'assets/img/consumables/40px-Refillable_Potion_item.png', 100, 'Objet', 0, 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 0, 0, 0, 0, 0),
('Potion de Soin', 'Restaure 4 points de santé toutes les 0,5 secondes pendant 15 secondes.', '+120 PV', 50, 'consumable', 'assets/img/consumables/Health_Potion_item.png', 200, 'Objet', 0, 0, 0, 0, 0, 0, 0, 0, 120, 0, 0, 0, 0, 0, 0, 0),
('Alteration Divinatoire', 'Objet unique : Place une balise de vision lointaine visible à l\emplacement ciblé, offrant une vision permanente de la zone environnante, y compris par-dessus le terrain et à travers les buissons . Elle confère également une vision de la zone dans un rayon de 800 unités pendant 2 secondes. Lorsqu\elle détecte un champion ennemi, la balise augmente son rayon de vision à 800 unités et se détruit après 3 secondes.', 'délai de récupération : 198 à 99 secondes, selon le niveau moyen du champion \nPortée : 4 000 unités', 0, 'consumable', 'assets/img/consumables/Farsight_Alteration_item.png', 999, 'Balise', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('Brouilleur Oracle', 'Consommez une charge pour invoquer un drone balayeur qui vous escorte pendant les 8 prochaines secondes, détectant les ennemis proches qui ne sont pas visibles', 'temps de recharge de 160 à 100 secondes (basé sur le niveau moyen du champion) \n2 charges ; portée de 600 à 750 (basée sur le niveau)', 0, 'consumable', 'assets/img/consumables/Oracle_Lens_item.png', 999, 'Balise', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('Balise de Vision', 'Unique => Bijou : Consommez une charge pour placer une balise totémique invisible à l\emplacement ciblé, qui permet de voir la zone environnante pendant 90 à 120 secondes (en fonction du niveau moyen du champion)', 'temps de recharge de 210 à 90 secondes (en fonction du niveau moyen du champion) \n2 charges ; portée de 600)', 0, 'consumable', 'assets/img/consumables/Stealth_Ward_item.png', 999, 'Balise', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('Elixir de Fer', 'Confère 300 points de vie bonus , 25 % de ténacité et une taille augmentée de 15 % pendant 180 secondes. Tant que l\effet est actif, les déplacements laissent derrière eux une traînée qui confère brièvement 15 % de vitesse de déplacement bonus aux champions alliés présents. Peut être utilisé même après la mort.', '+300 PV bonus \n+25% ténacité \n+15% taille \n+15% vitesse de déplacement', 500, 'consumable', 'assets/img/consumables/Elixir_of_Iron_item.png', 50, 'Objet', 0, 0, 0, 0, 0, 0, 0, 0, 300, 0, 0, 0, 25, 0, 0, 0),
('Elixir de Rage', 'Confère 30 points de dégâts d\attaque bonus et soigne de 12 % des dégâts physiques infligés aux champions pendant 180 secondes. L\efficacité du soin est réduite à 33 % pour les dégâts de zone. Peut être utilisé même après la mort.', '+30 pts dégâts d\attaque bonus', 500, 'consumable', 'assets/img/consumables/Elixir_of_Wrath_item.png', 50, 'Objet', 30, 0, 0, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 12, 0),
('Elixir de Sorcellerie', 'Confère 50 de puissance et 15 de régénération de mana bonus pendant 180 secondes. Tant que cet effet est actif, infliger des dégâts aux champions ou tourelles ennemis inflige 25 dégâts bruts bonus (5 secondes de délai de récupération contre chaque champion, aucun délai de récupération contre les tourelles). Peut être utilisé après la mort.', '+50 puissance magique \n+15 régénération de mana', 500, 'consumable', 'assets/img/consumables/Elixir_of_Sorcery_item.png', 50, 'Objet', 0, 0, 0, 0, 0, 50, 0, 15, 0, 0, 0, 0, 0, 0, 0, 0),
('Balise de Contrôle', 'Place une balise de contrôle visible à l\emplacement ciblé (portée de 600), offrant une vue sur les 900 unités environnantes. Sa vue ne peut être désactivée.', 'Révèle et désactive les balises ennemies \nRévèle les pièges dissimulés par l\ennemi \nRévèle les champions camouflés', 75, 'consumable', 'assets/img/consumables/Control_Ward_item.png', 150, 'Objet', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- B. BOTTES
INSERT INTO items (nom, description_passive, description_stat, prix, categorie, image, stock, role, ad, crit_rate, attack_speed, physical_vamp, armor_penetration, ap, mana, magic_penetration, health, health_regeneration, armor, magic_resistance, tenacity, ability_haste, omnivamp, favoris) VALUES
('Bottes de Célérité', 'Augmente les effets de déplacement.', '+55 en vitesse de déplacement. \nPassif : Unique => Pieds agiles : Gain de 25 % de résistance au ralentissement.', 1000, 'boots', 'assets/img/boots/Boots_of_Swiftness_item.png', 20, 'Bottes', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('Jambières du Berzerker', 'Vitesse d\attaque et déplacement.', '+25 % de vitesse d\attaque \n+45 en vitesse de déplacement', 1100, 'boots', 'assets/img/boots/Berserker_s_Greaves_item.png', 25, 'Bottes', 0, 0, 25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('Bottes de Base', 'Vitesse de déplacement standard.', '+25 en vitesse de déplacement', 300, 'boots', 'assets/img/boots/Boots_item.png', 50, 'Bottes', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('Sandales de Mercure', 'Ténacité et résistance magique.', '+20 résistance magique \n+45 en vitesse de déplacement \n+30% de ténacité', 1250, 'boots', 'assets/img/boots/Mercury_s_Treads_item.png', 30, 'Bottes', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20, 30, 0, 0, 0),
('Coques en Acier', 'Réduit les dégâts des attaques de base.', '+35 armure \n+45 en vitesse de déplacement. \nPassif : Unique => Blindage : Réduit tous les dégâts de base entrants de 10 % (à l\exclusion des attaques de tourelle).', 1200, 'boots', 'assets/img/boots/Plated_Steelcaps_item.png', 30, 'Bottes', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 35, 0, 0, 0, 0, 0),
('Chaussures de Sorcier', 'Pénétration magique.', '+12 pénétration magique \n+45 en vitesse de déplacement', 1100, 'boots', 'assets/img/boots/Sorcerer_s_Shoes_item.png', 40, 'Bottes', 0, 0, 0, 0, 0, 0, 0, 12, 0, 0, 0, 0, 0, 0, 0, 0),
('Bottes de Lucidité', 'Accélération de compétence.', '+10 accélération de capacité \n+45 en vitesse de déplacement. \nPassif : Unique => Perspicacité ionienne : Gagnez 10 points de hâte de sort d\invocateur.', 900, 'boots', 'assets/img/boots/Ionian_Boots_of_Lucidity_item.png', 35, 'Bottes', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0);

-- C. OBJETS PRINCIPAUX
INSERT INTO items (nom, description_passive, description_stat, prix, categorie, image, nombre_achete, stock, role, ad, crit_rate, attack_speed, physical_vamp, armor_penetration, ap, mana, magic_penetration, health, health_regeneration, armor, magic_resistance, tenacity, ability_haste, omnivamp, favoris) VALUES
('Coiffe de Rabadon', 'Opus magique: Vous augmentez votre puissance total de 30%', '+130 AP', 3500, 'item', 'assets/img/items/Coiffe_de_Rabadon_item.png', 120, 10, 'Mage', 0, 0, 0, 0, 0, 130, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('Lame d\Infini', 'Perfection : Augmente les dégâts de vos coups critiques de 40%.', '+80 AD \n+25% Chances de coup critique', 3500, 'item', 'assets/img/items/Lame_d_infini_item.png', 95, 15, 'Tireur', 80, 25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('Sablier de Zhonya', 'Stase : Devenez invincible et inciblable pendant 2,5 secondes, mais vous ne pouvez plus agir.', '+120 AP \n+50 Armure', 3250, 'item', 'assets/img/items/Sablier_de_Zhonya_item.png', 80, 20, 'Mage', 0, 0, 0, 0, 0, 120, 0, 0, 0, 0, 50, 0, 0, 0, 0, 0),
('Echo de Luden', 'Chargement : Gagnez des charges en vous déplaçant ou en lançant des sorts. À 100 charges, votre prochain sort inflige des dégâts magiques supplémentaires.', '+95 AP \n+600 Mana \n+20 Accélération de compétence', 2750, 'item', 'assets/img/items/Echo_de_Luden_item.png', 60, 12, 'Mage', 0, 0, 0, 0, 0, 95, 600, 0, 0, 0, 0, 0, 0, 20, 0, 0),
('Cotte Épineuse','Épines : Renvoie des dégâts magiques aux attaquants et leur applique Hémorragie.', '+75 armure \n+150 PV', 2450, 'item', 'assets/img/items/Cotte_Épineuse_item.png', 45, 18, 'Tank', 0, 0, 0, 0, 0, 0, 0, 0, 150, 0, 75, 0, 0, 0, 0, 0),
('Flèches de Yun Tal', 'Lame dentelée : Vos coups critiques infligent des dégâts de saignement sur la durée.', '+65 AD \n+25% Chances de coup critique', 3100, 'item', 'assets/img/items/Fleches_de_Yun_Tal_item.png', 35, 25, 'Tireur', 65, 25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('Hydre Vorace', 'Croissant : Vos attaques et compétences infligent des dégâts physiques en zone autour de la cible.', '+70 AD \n+20 Accélération de compétence \n+10% Vol de vie', 3300, 'item', 'assets/img/items/Hydre_vorace_item.png', 30, 22, 'Combattant', 70, 0, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20, 0, 0),
('Coeuracier', 'Consommation colossale : Charge une attaque contre les champions qui augmente vos PV max de façon permanente.', '+800 PV \n+200% Récupération de base des PV', 3000, 'item', 'assets/img/items/Coeuracier_item.png', 25, 15, 'Tank', 0, 0, 0, 0, 0, 0, 0, 0, 800, 200, 0, 0, 0, 0, 0, 0),
('Eclipse', 'Frappe ascendante : Toucher un champion avec 2 attaques ou sorts séparés inflige des dégâts bonus et vous donne un bouclier.', '+70 AD \n+15 Accélération de compétence', 2900, 'item', 'assets/img/items/Eclipse_item.png', 20, 18, 'Combattant', 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 15, 0, 0),
('Bâton du Vide', 'Néant : Ignore 40% de la résistance magique de l\adversaire.', '+90 AP \n+40% Pénétration magique', 3000, 'item', 'assets/img/items/Bâton_du_vide_item.png', 25, 15, 'Mage', 0, 0, 0, 0, 0, 90, 0, 40, 0, 0, 0, 0, 0, 0, 0, 0),
('Percepteur', 'Mort et taxes : Exécute instantanément les ennemis tombant sous 5% de leurs PV.', '+60 AD \n+25% Chances de coup critique \n+15 Létalité', 3000, 'item', 'assets/img/items/Percepteur_item.png', 20, 18, 'Tireur', 60, 25, 0, 0, 15, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('Visage Spirituel', 'Vitalité sans fin : Augmente de 25% tous les soins et boucliers reçus.', '+450 PV \n+60 Résistance magique \n+10 Accélération de compétence', 2700, 'item', 'assets/img/items/Visage_spirituel_item.png', 22, 16, 'Tank', 0, 0, 0, 0, 0, 0, 0, 0, 450, 0, 0, 60, 0, 10, 0, 0),
('Opportunité', 'Préparation : Gagnez de la létalité bonus si vous n\avez pas combattu récemment.', '+55 AD \n+18 Létalité \n+5% Vitesse de déplacement', 2700, 'item', 'assets/img/items/Opportunité_item.png', 24, 17, 'Assassin', 55, 0, 0, 0, 18, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('Créateur de Failles', 'Corruption du Néant : Augmente vos dégâts de 2% par seconde en combat (max 10%) et octroie de l\omnivampirisme.', '+80 AP \n+15 Accélération de compétence \n+350 PV', 3100, 'item', 'assets/img/items/Créateur_de_faille_item.png', 26, 19, 'Mage', 0, 0, 0, 0, 0, 80, 0, 0, 350, 0, 0, 0, 0, 15, 0, 0),
('Sceptre de Rylai', 'Givre : Vos sorts ralentissent les ennemis de 30% pendant 1 seconde.', '+75 AP \n+400 PV', 2600, 'item', 'assets/img/items/Scepte_de_Rylai_item.png', 23, 18, 'Mage', 0, 0, 0, 0, 0, 75, 0, 0, 400, 0, 0, 0, 0, 0, 0, 0),
('Flamme-ombre', 'Cendres de la fleur : Les dégâts infligés aux ennemis sous 35% de PV sont augmentés de 20%.', '+115 AP \n+12 Pénétration magique', 3200, 'item', 'assets/img/items/Flamme-ombre_item.png', 27, 20, 'Mage', 0, 0, 0, 0, 0, 115, 0, 12, 0, 0, 0, 0, 0, 0, 0, 0),
('Lance de Shojin', 'Force du dragon : Augmente l\accélération de compétence de vos sorts de base et renforce leurs dégâts.', '+55 AD \n+20 Accélération de compétence \n+300 PV', 3100, 'item', 'assets/img/items/Lance_de_Shojin_item.png', 21, 17, 'Combattant', 55, 0, 0, 0, 0, 0, 0, 0, 300, 0, 0, 0, 0, 20, 0, 0),
('Tourment de Liandry', 'Tourment : Vos sorts brûlent les ennemis selon un pourcentage de leurs PV max sur 3 secondes.', '+90 AP \n+300 PV', 3000, 'item', 'assets/img/items/Tourment_de_Liandry_item.png', 24, 19, 'Mage', 0, 0, 0, 0, 0, 90, 0, 0, 300, 0, 0, 0, 0, 0, 0, 0),
('Orgueil', 'Éminence : Les éliminations de champions invoquent une statue qui augmente votre AD de façon permanente.', '+50 AD \n+15 Accélération de compétence \n+18 Létalité', 3000, 'item', 'assets/img/items/Orgueil_item.png', 22, 18, 'Assassin', 50, 0, 0, 0, 18, 0, 0, 0, 0, 0, 0, 0, 0, 15, 0, 0),
('Aube et Crépuscule', 'Première lumière : Augmente la puissance de vos soins et boucliers en fonction de votre régénération de mana.', '+40 Puissance \n+20 Accélération de compétence \n+150% Régén. Mana', 3100, 'item', 'assets/img/items/Aube_et_crépuscule_item.png', 23, 17, 'Support', 0, 0, 0, 0, 0, 40, 0, 0, 0, 0, 0, 0, 0, 20, 0, 0),
('Lame du Roi Déchu', 'Brume : Vos attaques infligent des dégâts à l\impact basés sur les PV actuels de la cible.', '+40 AD \n+25% Vitesse d\attaque \n+10% Vol de vie', 3200, 'item', 'assets/img/items/Lame_du_roi_déchu_item.png', 25, 16, 'Tireur', 40, 0, 25, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('Faim Insassiable', 'Angoisse : Inflige des dégâts et vous soigne périodiquement tant que vous êtes en combat.', '+400 PV \n+55 Armure \n+10 Accélération de compétence', 3100, 'item', 'assets/img/items/Faim_insassiable_item.png', 26, 18, 'Tank', 0, 0, 0, 0, 0, 0, 0, 0, 400, 0, 55, 0, 0, 10, 0, 0),
('Soif-de-sang', 'Bouclier de sang : Le surplus de soin issu du vol de vie se transforme en bouclier.', '+80 AD \n+18% Vol de vie', 3400, 'item', 'assets/img/items/Soif-de-sang_item.png', 24, 17, 'Tireur', 80, 0, 0, 18, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('Dance de la Mort', 'Défiance : 30% des dégâts subis sont différés. Les éliminations purgent ces dégâts et vous soignent.', '+65 AD \n+40 Armure \n+15 Accélération de compétence', 3300, 'item', 'assets/img/items/Dance_de_la_mort_item.png', 25, 19, 'Combattant', 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 40, 0, 0, 15, 0, 0);

-- STOCK (Table supplémentaire)
INSERT INTO stock (id_item, quantite)
SELECT id, stock FROM items;