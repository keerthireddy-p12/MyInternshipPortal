pipeline {
    agent any

    stages {

        stage('Checkout') {
            steps {
                echo 'Checking out MyInternshipPortal project...'
                checkout scm
            }
        }

        stage('Build') {
            steps {
                echo 'Building MyInternshipPortal...'
            }
        }

        stage('Test') {
            steps {
                echo 'Testing MyInternshipPortal...'
            }
        }

        stage('Deploy') {
            steps {
                echo 'Deploying MyInternshipPortal...'
            }
        }
    }
}