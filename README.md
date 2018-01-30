# SiMoNe
Die Grundidee hinter SiMoNe ist folgende:
Es gibt ein Serversystem das regelmäßig Daten von vielen weiteren Servern abholt (network), aufbereitet und anzeigt (Monitoring).
Auf den zu überwachenden Servern sollen möglichst einfache (Simple) Scripte (siehe example) laufen die irgendein System überwachen und wenn was nicht passt eine FehlerXML anlegen welche SiMoNe abholt und auswertet

# Warum abholen und nicht aktiv senden?
Es sollen auch Server überwacht werden auf welchen dritte Zugriff haben, somit kann eine gesicherte Übertragung zu meinem SiMoNe System nicht sichergestellt werden. Mit einer fehlerhaften XML kann das System nur wenig gestört werden, werden Daten aktiv gesendet kann viel mehr Unsinn auf dem SiMoNe-Server getrieben werden.
Weiterhin würde es die Komplexität der Scripte auf den zu überwachenden Systemen erhöhen.
Ebenso kann durch dieses System relativ einfach ein Serverausfall detektiert werden.
