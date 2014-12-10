  
 import java.awt.Color;
 import java.awt.image.BufferedImage;
 import java.io.BufferedReader;
 import java.io.File;
 import java.io.FileReader;
 import java.io.IOException;
 import java.util.StringTokenizer;
 import java.util.TreeMap;
  
 import javax.imageio.ImageIO;

 public class ClassifyWithParallelepipedAlgorithm
   {
   public static void main(String[] args) throws IOException
     {
     // Check parameters names.
     if (args.length != 3)
       {
       System.err.println("Must pass three command-line parameters to this application:");
       System.err.println(" - The original image (from which samples will be extracted;");
       System.err.println(" - The file with the classes names and colors");
       System.err.println(" - The file with the signatures for each class");
       System.exit(1);
       }
     // Open the original image.
     BufferedImage input = ImageIO.read(new File(args[0]));
     // Read the classes description file. 
     BufferedReader br = new BufferedReader(new FileReader(args[1]));
     // Store the classes color in a map.
     TreeMap<Integer,Color> classMap = new TreeMap<Integer, Color>();
     while(true)
       {
       String line = br.readLine(); 
       if (line == null) break;
       if (line.startsWith("#")) continue;
       StringTokenizer st = new StringTokenizer(line);
       if (st.countTokens() < 4) continue;
       int classId = Integer.parseInt(st.nextToken());
       int r = Integer.parseInt(st.nextToken());
       int g = Integer.parseInt(st.nextToken());
       int b = Integer.parseInt(st.nextToken());
       classMap.put(classId,new Color(r,g,b));
       }
     br.close();
     // Read the signatures from a file. 
     TreeMap<Integer,int[]> minMap = new TreeMap<Integer, int[]>();
     TreeMap<Integer,int[]> maxMap = new TreeMap<Integer, int[]>();
     br = new BufferedReader(new FileReader(args[2]));
     while(true)
       {
       String line = br.readLine(); 
       if (line == null) break;
       if (line.startsWith("#")) continue;
       StringTokenizer st = new StringTokenizer(line);
       if (st.countTokens() < 7) continue;
       int classId = Integer.parseInt(st.nextToken());
       int[] min = new int[3]; int[] max = new int[3];
       min[0] = Integer.parseInt(st.nextToken());
       min[1] = Integer.parseInt(st.nextToken());
       min[2] = Integer.parseInt(st.nextToken());
       max[0] = Integer.parseInt(st.nextToken());
       max[1] = Integer.parseInt(st.nextToken());
       max[2] = Integer.parseInt(st.nextToken());
       minMap.put(classId,min);
       maxMap.put(classId,max);
       }
     br.close();
     // Create a color image to hold the results of the classification.
     int w = input.getWidth();  int h = input.getHeight();
     BufferedImage results = new BufferedImage(w,h,BufferedImage.TYPE_INT_RGB);
     // Do the classification, pixel by pixel, selecting which class they should be assigned to.
     for(int row=0;row<h;row++)
       for(int col=0;col<w;col++)
         {
         int rgb = input.getRGB(col,row);
         int r = (int)((rgb&0x00FF0000)>>>16); // Red level
         int g = (int)((rgb&0x0000FF00)>>>8);  // Green level
         int b = (int) (rgb&0x000000FF);       // Blue level
         // To which class should we assign this pixel?
         Color assignedClass = new Color(0,0,0); // unassigned.
         for(int key:minMap.keySet())
           {
           if (isBetween(r,g,b,minMap.get(key),maxMap.get(key))) 
             {
             assignedClass = classMap.get(key);            
             }
           }
         // With the color, paint the output image.
         results.setRGB(col,row,assignedClass.getRGB());
         }
     // At the end, store the resulting image.
     ImageIO.write(results,"PNG",new File("classified-with-parallelepiped.png"));
     }
   
   private static boolean isBetween(int r,int g,int b,int[] min,int[] max)
     {
     return ((min[0] <= r) && (r <= max[0]) &&
             (min[1] <= g) && (g <= max[1]) &&
             (min[2] <= b) && (b <= max[2]));
     }
   } 
