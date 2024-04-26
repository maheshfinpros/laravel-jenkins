pipeline {
    agent any
    
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        stage('Execute Commands Over SSH') {
            steps {
                script {
                    // Define SSH credentials ID
                    def sshCredentialsId = '3ee699db-7305-49a5-98ea-bad2b9b8ac15'
                    
                    // Define SSH remote host
                    def remoteHost = '3.110.147.246'
                    
                    // Define SSH commands to execute
                    def sshCommands = [
                        "sudo apt update",
                        "sudo apt install -y apache2"
                        // Add more commands here as needed
                    ]
                    
                    // Execute SSH commands
                    sshCommand remote: [name: 'ssh-remote', host: remoteHost, credentialsId: sshCredentialsId, user: 'ubuntu'], command: sshCommands.join(' && ')
                }
            }
        }
    }
}
