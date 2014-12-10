Parallelepiped Classifier Web Application for Image Classification
==================================================================
The WebApp is written in PHP and Java. It makes use of HTML5 Canvas to interactively help the user create the Sample Data File.

PHP is used to upload the input image, create the sample  data file and finally render the classified image. Java is used to create the Signature File and process the image using that file to generate the classified output image.

Requirements to deploy the application:
1/ JDK
2/ PHP Server - LAMPP/XAMPP
3/ Modern Browser - Mozilla Firefox / Google Chrome

Source Code Directory Files:
742.png // Input Image
classified-with-parallelepiped.png // Output Image
new_parallel_signatures.txt // Signature File
myClasses.txt // Class Description Files
mySamples.txt // Sample Data Files
classify.php
generateSample.php
main.php
ClassifyWithParallelepipedAlgorithm.java // Classify the Image File
CreateParallelepipedSignatures.java // Generates the Signature File
upload.php
index.html
style.css
classify.jar
ClassifyWithParallelepipedAlgorithm.class
signatures.jar
CreateParallelepipedSignatures.class

References: 
* The Parallelepiped Classifier Concept and Java Implementation          
  http://www.lac.inpe.br/JIPCookbook/7020-tutorial-supervisedclassification.jsp#tutorialsabrieftutorialonsupervisedimageclassificationtheparallelepipedclassifier
